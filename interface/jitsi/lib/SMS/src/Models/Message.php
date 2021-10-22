<?php
/*
 * D7SMSLib
 *
 */

namespace D7SMSLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class Message implements JsonSerializable
{
    /**
     * Destination Number
     * @required
     * @var array $to public property
     */
    public $to;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $content public property
     */
    public $content;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $from public property
     */
    public $from;

    /**
     * Constructor to set initial or default values of member properties
     * @param array  $to      Initialization value for $this->to
     * @param string $content Initialization value for $this->content
     * @param string $from    Initialization value for $this->from
     */
    public function __construct()
    {
        if (3 == func_num_args()) {
            $this->to      = func_get_arg(0);
            $this->content = func_get_arg(1);
            $this->from    = func_get_arg(2);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['to']      = $this->to;
        $json['content'] = $this->content;
        $json['from']    = $this->from;

        return $json;
    }
}
