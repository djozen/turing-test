<?php
/**
 * Session Interface
 *
 * Author: Johan Nagou
 * Date: 2013-05-31
 */

namespace TuringTest\Session;


interface ITuringSession {
    function __construct($session = null);
    public function set($name, $value);
    public function get($name);
}