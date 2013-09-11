<?php
/**
 * Session with Http Foundation Symfony 2
 *
 * Author: Johan Nagou
 * Date: 2013-05-31
 */

namespace TuringTest\Session;


class SymfonySession implements ITuringSession
{
    private $session;

    function __construct($session = null)
    {
        $this->session = $session;
    }


    public function set($name, $value)
    {
        $this->session->set($name, $value);
    }

    public function get($name)
    {
        return $this->session->get($name);
    }

}