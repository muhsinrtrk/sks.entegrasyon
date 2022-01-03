<?php

namespace App\Library\Response;

use App\Service\FilterService;
use App\Service\LanguageService;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends Response
{

    private $json;

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
        $this->json = new Json();
    }

    function getStatus()
    {
        return $this->json->status;
    }

    function getMessage()
    {
        return $this->json->message;
    }

    function getErrorCode()
    {
        return $this->json->errorCode;
    }

    function getData()
    {
        return $this->json->data;
    }

    function getPaging()
    {
        return $this->json->paging;
    }

    function setStatus($status)
    {
        $this->json->status = $status;

        return $this;
    }

    function setMessage($message)
    {
        $this->json->message = $message;

        return $this;
    }

    function setMessageWithCode($messageCode)
    {
        $this->json->message = LanguageService::getInstance()->get($messageCode);

        return $this;
    }

    function setErrorCode($errorCode)
    {
        $this->json->errorCode = $errorCode;

        return $this;
    }

    function setData($data)
    {

        if (gettype($data) == 'array') {
            if (false == empty($data) && !isset($data[0])) {
                $data = array($data);
            }
        } else {
            $data = array($data);
        }
        $this->json->data = $data;
        return $this;
    }

    /**
     * @param false $total
     * @param false $start
     * @param false $limit
     * @return $this
     * @desc Paging değişkenlerini dönen metot. Parametreler gönderilmezse FilterService'den almaya çalışır.
     * @desc FilterService'teki değişkenler Model::filter() içerisinde set edilir.
     */
    function setPaging($total = false, $start = false, $limit = false)
    {

        if($start === false) {
            $start = FilterService::$start ?? 0;
        }

        if($limit === false) {
            $limit = FilterService::$limit ?? 50;
        }

        if($total === false) {
            $total = FilterService::$total ?? 0;
        }

        $page = $limit > 0 ? ceil($total / $limit) : 1;

        $this->json->paging = [
            'total' => $total,
            'start' => $start,
            'limit' => $limit,
            'page' => $page
        ];

        return $this;
    }

    function send()
    {

        try {
            $jwtData = \App\Library\Jwt\Token::decode();

            if ($jwtData !== false) {
                $this->json->session = $jwtData->data;
            }
        } catch (\Exception $ex) {
        }

        if (empty($this->json->paging)) {
            unset($this->json->paging);
        }

        //  $this->setContent($this->json->__toJson());
        //        $r = parent::send();

        return $this;
    }

    function sendParent()
    {

        $this->headers->set("Content-Type", "application/json");
        $this->setContent($this->json->__toJson());
        parent::send();
        $this->json->reset();
    }

    function getAllData()
    {

        return $this->json->__toArray();
    }
}

class Json
{

    public $status = false;
    public $message = "";
    public $errorCode = "";
    public $data = array();
    public $paging = array();

    public function __construct()
    {
    }

    public function __toJson()
    {
        return json_encode(get_object_vars($this));
    }

    public function __toArray()
    {
        return get_object_vars($this);
    }

    public function reset()
    {
        $this->status = false;
        $this->message = array();
        $this->errorCode = "";
        $this->data = array();
        $this->paging = array();
    }
}
