<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib;

use D7SMSLib\Controllers;

/**
 * D7SMSLib client class
 */
class D7SMSClient
{
    /**
     * Constructor with authentication and configuration parameters
     */
    public function __construct(
        $aPIUsername = null,
        $aPIPassword = null
    ) {
        Configuration::$aPIUsername = $aPIUsername ? $aPIUsername : Configuration::$aPIUsername;
        Configuration::$aPIPassword = $aPIPassword ? $aPIPassword : Configuration::$aPIPassword;
    }
    /**
     * Singleton access to API controller
     * @return Controllers\APIController The *Singleton* instance
     */
    public function getClient()
    {
        return Controllers\APIController::getInstance();
    }
}
