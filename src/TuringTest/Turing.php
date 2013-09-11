<?php
/*******************************************************************************
 * Software: Turing Test class                                                               *
 * Version:    0.3                                                               *
 * Date:       2007-01-20                                                         *
 * Author:     William POTTIER                                                   *
 * License:    Freeware
 *
 * Date:       2013-05-31
 * Updated by: Johan Nagou
 *
 * PSR0 implementation of Turing Test by William POTTIER
 *                                                                              *
 * You may use, modify and redistribute this software as you wish.              *
 *******************************************************************************/

namespace TuringTest;


class Turing implements ITuring
{
    /**
     * The configuration
     *
     * @var array
     *    The array of configuration
     */
    private $cfg;

    /**
     * If pass session object use this
     *
     * @var Session Object
     */
    private $session = null;

    /**
     * @var string Question
     */
    private $question;

    //private $nb, $u, $x, $y, $z, $mot_z, $c, $color;
    private $nb, $u, $x, $y, $z, $mot_z;

    /**
     * Constructor
     *
     * @param string $config
     */
    public function __construct($config = "", $session = null)
    {
        // Load config file ( retrieve all words )
        if (empty($config)) {
            $config = __DIR__ . "/dictionnary.json";
        }
        if (!file_exists($config)) {
            $config = __DIR__ . "/" . $config;
        }
        $this->cfg = json_decode(file_get_contents($config));

        // We check if Session is open
        $session_id = session_id();
        if (empty($session_id) && $session === null) {
            throw new \Exception("Can't use Turing test because session is close.");
        } else {
            $this->session = $session;
        }

    }

    /**
     * Generate the ask
     *
     * @param int $force_new
     * @return mixed
     */
    public function generateQuestion($force_new = 0)
    {
        if ($this->nb == '' || $force_new == 1) {
            $this->nb = mt_rand(0, count($this->cfg->ask) - 1);
        }

        // We get the random number
        $this->x = mt_rand(1, 50);
        $this->y = mt_rand(1, 50);
        $this->z = mt_rand(0, count($this->cfg->answer->words) - 1);
        $this->mot_z = $this->cfg->answer->words[$this->z];
        $this->u = mt_rand(0, strlen($this->mot_z) - 1);
        /*$this->c = mt_rand(0, count($this->cfg->answer->colors) - 1);
        $this->color = $this->cfg->answer->colors[$this->c];*/

        // We get the result and we save it in $_SESSION
        $this->session->set('turing', $this->GetResult());

        //$search = array('%x', '%y', '%mot_z', '%u', '%color');
        $search = array('%x', '%y', '%mot_z', '%u');
        $replace = array(
            $this->x,
            $this->y,
            $this->mot_z,
            $this->u + 1,
           // $this->color
        );
        $this->question = str_replace(
            $search,
            $replace,
            $this->cfg->ask[$this->nb]
        );

        return $this->question;
    }

    /**
     * Get the result
     *
     * @return mixed
     */
    public function getResult()
    {
        $result = $this->cfg->result[$this->nb];
        // We explode the string to get function name and param list
        $temp1 = explode('(', $result);
        // Good, wa have the callback
        $callback = $temp1[0];
        // Now the params
        $params = trim($temp1[1], ')');
        $param = explode(',', $params);
        $count_param = count($param);
        for ($i = 0; $i < $count_param; $i++) {
            $param_callback[$i] = $this->$param[$i];
        }

        // We run the callback
        return call_user_func_array(array($this, $callback), $param_callback);
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }



    /*
     * Define all callback method here ( for results )
     */

    private function addition($a, $b)
    {
        return $a + $b;
    }

    private function letterOfWord($pos, $mot)
    {
        return $mot[$pos];
    }

    private function _max($a, $b)
    {
        return max(array($a, $b));
    }

    private function _min($a, $b)
    {
        return min(array($a, $b));
    }

   /* private function horse_color($color)
    {
        return $color;
    }*/
}