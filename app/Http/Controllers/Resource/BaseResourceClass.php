<?php

namespace App\Controller\Resources;

use App\Helpers;
use App\Library\Response\JsonResponse;
use App\Library\Router\Router;
use App\Library\Router\Routing;
use Symfony\Component\HttpFoundation\Request;

interface  BaseResourceClassInterface
{
}

abstract class BaseResourceClass extends JsonResponse
{

    public function getAdminResource($data)
    {
        return $data;
    }

    public function getCustomerResource($data)
    {
        return $data;
    }

    public function modify($data)
    {
        $uri = explode("/", ltrim(Routing::getInstance()->getRequest()->getRequestUri(), '/'));
        $apiVersion = $uri[1];
        $apiGroup = $uri[2];

        switch ($apiGroup) {
            case 'admin':
                return $this->getAdminResource($data);
                break;
            case 'customer':
                return $this->getCustomerResource($data);
                break;
            default :
                return $this->getCustomerResource($data);
                break;
        }
    }

}
