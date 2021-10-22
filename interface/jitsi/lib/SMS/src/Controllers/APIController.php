<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib\Controllers;

use D7SMSLib\APIException;
use D7SMSLib\APIHelper;
use D7SMSLib\Configuration;
use D7SMSLib\Models;
use D7SMSLib\Exceptions;
use D7SMSLib\Http\HttpRequest;
use D7SMSLib\Http\HttpResponse;
use D7SMSLib\Http\HttpMethod;
use D7SMSLib\Http\HttpContext;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class APIController extends BaseController
{
    /**
     * @var APIController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return APIController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Check account balance
     *
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getBalance()
    {

        //prepare query string for API call
        $_queryBuilder = '/balance';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::$BASEURI . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$aPIUsername, Configuration::$aPIPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 500) {
            throw new APIException('Internal Server Error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);
    }

    /**
     * Send SMS  to recipients using D7 SMS Gateway
     *
     * @param  array  $options    Array with all options for search
     * @param Models\SendSMSRequest $options['body']         Message Body
     * @param string                $options['contentType']  TODO: type description here
     * @param string                $options['accept']       TODO: type description here
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createSendSMS(
        $options
    ) {

        //prepare query string for API call
        $_queryBuilder = '/send';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::$BASEURI . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Content-Type'    => $this->val($options, 'contentType'),
            'Accept'          => $this->val($options, 'accept')
        );

        //json encode body
        $_bodyJson = Request\Body::Json($this->val($options, 'Body'));

        //set HTTP basic auth parameters
        Request::auth(Configuration::$aPIUsername, Configuration::$aPIPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, $_bodyJson);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 500) {
            throw new APIException('Internal Server Error', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);
    }

    /**
     * Send Bulk SMS  to multiple recipients using D7 SMS Gateway
     *
     * @param Models\BulkSMSRequest $body         Message Body
     * @param string                $contentType  TODO: type description here
     * @param string                $accept       TODO: type description here
     * @return void response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createBulkSMS(
        $body,
        $contentType,
        $accept
    ) {

        //prepare query string for API call
        $_queryBuilder = '/sendbatch';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl(Configuration::$BASEURI . $_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => BaseController::USER_AGENT,
            'Content-Type'    => $contentType,
            'Accept'          => $accept
        );

        //json encode body
        $_bodyJson = Request\Body::Json($body);

        //set HTTP basic auth parameters
        Request::auth(Configuration::$aPIUsername, Configuration::$aPIPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, $_bodyJson);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);
    }


    /**
    * Array access utility method
     * @param  array          $arr         Array of values to read from
     * @param  string         $key         Key to get the value from the array
     * @param  mixed|null     $default     Default value to use if the key was not found
     * @return mixed
     */
    private function val($arr, $key, $default = null)
    {
        if (isset($arr[$key])) {
            return is_bool($arr[$key]) ? var_export($arr[$key], true) : $arr[$key];
        }
        return $default;
    }
}
