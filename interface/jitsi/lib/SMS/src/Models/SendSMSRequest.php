<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib\Models;

use JsonSerializable;

/**
 *Send SMS Request
 */
class SendSMSRequest implements JsonSerializable
{
    /**
     * Destination Mobile Number
     * @required
     * @var integer $to public property
     */
    public $to;

    /**
     * Sender ID / Number
     * @required
     * @var string $from public property
     */
    public $from;

    /**
     * Message Content
     * @required
     * @var string $content public property
     */
    public $content;

    /**
     * Constructor to set initial or default values of member properties
     * @param integer $to      Initialization value for $this->to
     * @param string  $from    Initialization value for $this->from
     * @param string  $content Initialization value for $this->content
     */
    public function __construct()
    {
        if (3 == func_num_args()) {
            $this->to      = func_get_arg(0);
            $this->from    = func_get_arg(1);
            $this->content = func_get_arg(2);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['to']      = $this->to;
        $json['from']    = $this->from;
        $json['content'] = $this->content;

        return $json;
    }
}
