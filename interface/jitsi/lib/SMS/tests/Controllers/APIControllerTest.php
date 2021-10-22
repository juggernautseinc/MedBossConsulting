<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib\Tests;

use D7SMSLib\APIException;
use D7SMSLib\Exceptions;
use D7SMSLib\APIHelper;
use D7SMSLib\Models;

class APIControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \D7SMSLib\Controllers\APIController Controller instance
     */
    protected static $controller;

    /**
     * @var HttpCallBackCatcher Callback
     */
    protected $httpResponse;

    /**
     * Setup test class
     */
    public static function setUpBeforeClass()
    {
        $client = new \D7SMSLib\D7SMSClient();
        self::$controller = $client->getClient();
    }

    /**
     * Setup test
     */
    protected function setUp()
    {
        $this->httpResponse = new HttpCallBackCatcher();
    }

    /**
     * Check Balance
     */
    public function testBalance()
    {

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->getBalance();
        } catch (APIException $e) {
        }

        // Test response code
        $this->assertEquals(
            500,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 500"
        );
    }

    /**
     * Send SMS  to a recipient using D7 SMS Gateway
     */
    public function testSendSMS()
    {
        // Parameters for the API call
        $input = array();
        $input['body'] = TestHelper::getJsonMapper()->mapClass(json_decode(
            '{  "to": 971562316353,  "from": "SignSMS",  "content": "Send single SMS Testing"}'),
            'D7SMSLib\\Models\\SendSMSRequest'
        );
        $input['contentType'] = 'application/json';
        $input['accept'] = 'application/json';

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createSendSMS($input);
        } catch (APIException $e) {
        }

        // Test response code
        $this->assertEquals(
            500,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 500"
        );
    }

    /**
     * Send SMS  to multiple recipients using D7 SMS Gateway
     */
    public function testBulkSMS()
    {
        // Parameters for the API call
        $body = TestHelper::getJsonMapper()->mapClass(json_decode(
            "{  \"messages\": [    {      \"to\": [        \"971562316353\",        \"971562316354\",        \"97" .
            "1562316355\"      ],      \"content\": \"Same content goes to three numbers\",      \"from\": \"Sign" .
            "SMS\"    }  ]}"),
            'D7SMSLib\\Models\\BulkSMSRequest'
        );
        $contentType = 'application/json';
        $accept = 'application/json';

        // Set callback and perform API call
        self::$controller->setHttpCallBack($this->httpResponse);
        try {
            self::$controller->createBulkSMS($body, $contentType, $accept);
        } catch (APIException $e) {
        }

        // Test response code
        $this->assertEquals(
            500,
            $this->httpResponse->getResponse()->getStatusCode(),
            "Status is not 500"
        );
    }
}
