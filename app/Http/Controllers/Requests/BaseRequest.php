<?php

namespace App\Controller\Requests;

use App\Library\Validation\RequestValidation;
use Symfony\Component\HttpFoundation\Request;

interface BaseRequestInterface
{
    public function adminRequest();

    public function defaultRequest();
}

abstract class BaseRequest extends Request implements BaseRequestInterface
{
    use RequestValidation;

    protected $apiVersion;
    /** $apiGroup [admin, customer, supplier, store]*/
    protected $apiGroup;
    protected $detectedUri;
    protected $initialRequest = null;


    public function __construct(Request $request)
    {
        $this->initialRequest = $request;

        $query = $request->query->all();
        $request_data = !empty($request->request) ? $request->request->all() : null;
        $attributes = !empty($request->attributes) ? $request->attributes->all() : [];
        $cookies = !empty($request->cookies) ? $request->cookies->all() : [];
        $files = !empty($request->files) ? $request->files->all() : [];
        $server = !empty($request->server) ? $request->server->all() : [];
        $content = !empty($request->content) ? $request->content : null;

        parent::__construct(
            $query, $request_data,
            $attributes,
            $cookies,
            $files,
            $server,
            $content
        );

        $this->detectRequest();
    }

    public function detectRequest()
    {
        try {
            $uri = explode("/", ltrim($this->getRequestUri(), '/'));
            $this->apiVersion = $uri[1];
            $this->apiGroup = $uri[2];

            switch ($this->apiGroup) {
                case 'admin':
                    $this->adminRequest();
                    break;
                case 'customer':
                    $this->defaultRequest();
                    break;
                default :
                    $this->defaultRequest();
                    break;
            }

        } catch (\Exception $e) {
            $this->defaultRequest();
        }

        $this->run();
    }

    public function run()
    {
        static::prepareRequestDataForValidation($this->initialRequest);
    }

    protected function addToFilter($key, $operation, $value)
    {

        $filter = $this->query->all()['filters'];

        if (empty($filter)) {
            $filter = "$key,$operation,$value";
        } else {
            $filter .= ";$key,$operation,$value";
        }

        $this->query->set('filter', $filter);
    }

    public function getRules()
    {
        try {
            return static::$rules;
        } catch (\Exception $e) {
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
