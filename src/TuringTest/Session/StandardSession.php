<?php
/**
 * Standard Session
 *
 * Author: Johan Nagou
 * Date: 2013-05-31
 */

namespace TuringTest\Session;


class StandardSession implements ITuringSession
{
    private $session;

    function __construct($session = null)
    {
        $this->session = $session;
        session_start(); // This object must be call before any display
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return $_SESSION[$name];
    }

}