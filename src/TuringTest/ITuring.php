<?php
/**
 * Author: Johan Nagou
 * Date: 2013-05-31
 */

namespace TuringTest;


interface ITuring {
  /**
   * Constructor
   *
   * @param string $config
   */
  public function __construct($config="config.json");

  /**
   * Generate the ask
   *
   * @param int $force_new
   * @return mixed
   */
  public function generateQuestion($force_new = 0);


  /**
   * Get the result
   *
   * @return mixed
   */
  public function getResult();
  /*
  * Define all callback method after ( for results )
  */
}