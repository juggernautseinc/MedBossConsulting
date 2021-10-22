<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib\Tests;

use D7SMSLib\Http\HttpCallBack;

/**
 * An HTTPCallBack that captures the request and response for use later
 */
class HttpCallBackCatcher extends HttpCallBack
{
    /**
     * Http request
     * @var D7SMSLib\Http\HttpRequest
     */
    private $request;

    /**
     * Http Response
     * @var D7SMSLib\Http\HttpResponse
     */
    private $response;

    /**
     * Create instance
     */
    public function __construct()
    {
        $instance = $this;
        parent::__construct(null, function ($httpContext) use ($instance) {
            $instance->request = $httpContext->getRequest();
            $instance->response = $httpContext->getResponse();
        });
    }

    /**
     * Get the HTTP Request object associated with this API call
     * @return D7SMSLib\Http\HttpRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the HTTP Response object associated with this API call
     * @return D7SMSLib\Http\HttpResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
