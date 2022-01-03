<?php


namespace App\Library\Router;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Routing extends Router
{

    public static $instance = null;
    /**
     * @var Response
     */
    private $commandResponse;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Router
     */
    static public function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setRequest(Request $request = null)
    {
        $request = $request ?? Request::createFromGlobals();
        $response = $response ?? new Response('', Response::HTTP_OK, ['content-type' => 'application/json']);
        $this->request = new RouterRequest($request, $response);
    }

    public function setParams($params)
    {
        $this->setPaths($params);
        $this->loadCache();
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request->symfonyRequest();
    }

    /**
     * @return JsonResponse
     */
    //: Response
    public function getResponse()
    {
        return $this->commandResponse;
    }

    /**
     * Run Routes
     *
     * @return void
     * @throws
     */
    public function run(): void
    {
        $uri = $this->getRequestUri();
        $method = $this->request->getMethod();
        $searches = array_keys($this->patterns);
        $replaces = array_values($this->patterns);

        $foundRoute = false;

        foreach ($this->routes as $data) {

            $route = $data['route'];
            if (!$this->request->validMethod($data['method'], $method)) {
                continue;
            }

            // Direct Route Match
            if ($route === $uri) {
                $foundRoute = true;
                $middlewareResponse = $this->runRouteMiddleware($data, 'before');
                if ($middlewareResponse !== true) {
                    $this->setCommandResponse($middlewareResponse);
                    break;
                }
                $this->runRouteCommand($data['callback']);
                $this->runRouteMiddleware($data, 'after');
                break;

                // Parameter Route Match
            } elseif (strstr($route, ':') !== false) {
                $route = str_replace($searches, $replaces, $route);
                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    $foundRoute = true;
                    $middlewareResponse = $this->runRouteMiddleware($data, 'before');
                    if ($middlewareResponse !== true) {
                        $this->setCommandResponse($middlewareResponse);
                        break;
                    }
                    array_shift($matched);
                    $matched = array_map(function ($value) {
                        return trim(urldecode($value));
                    }, $matched);
                    $this->runRouteCommand($data['callback'], $matched);
                    $this->runRouteMiddleware($data, 'after');
                    break;
                }
            }
        }

        // If it originally was a HEAD request, clean up after ourselves by emptying the output buffer
        if ($this->request()->isMethod('HEAD')) {
            ob_end_clean();
        }

        if ($foundRoute === false) {
            if (!$this->errorCallback) {
                $this->errorCallback = function () {
                    $this->response()
                        ->setStatusCode(Response::HTTP_NOT_FOUND)
                        ->sendHeaders();
                    return $this->exception('Looks like page not found or something went wrong. Please try again.');
                };
            }
            call_user_func($this->errorCallback);
        }
    }

    /**
     * Detect Routes Middleware; before or after
     *
     * @param array $middleware
     * @param string $type
     *
     * @return void
     */
    protected function runRouteMiddleware(array $middleware, string $type)
    {
        return $this->routerCommand()->beforeAfter($middleware[$type]);
    }

    /**
     * @return JsonResponse
     */
    public function setCommandResponse(Response $res): Response
    {
        return $this->commandResponse = $res;
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @param $command
     * @param $params
     *
     * @return void
     */
    protected function runRouteCommand($command, $params = [])
    {
        $this->commandResponse = $this->routerCommand()->runRoute($command, $params);
    }

}

