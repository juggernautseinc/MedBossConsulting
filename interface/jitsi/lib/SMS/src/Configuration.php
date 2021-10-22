<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib;

/**
 * All configuration including auth info and base URI for the API access
 * are configured in this class.
 */
class Configuration
{
    /**
     * The base Uri for API calls
     * @var string
     */
    public static $BASEURI = 'https://rest-api.d7networks.com/secure';

    /**
     * API Key
     * @var string
     */
    public static $aPIUsername = '';

    /**
     * API Token
     * @var string
     */
    public static $aPIPassword = '';
}
