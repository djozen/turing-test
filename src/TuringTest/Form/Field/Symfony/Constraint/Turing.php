<?php

/**
  * Created By Johan Nagou
  * Date : 2013-06-14
  *
  * Turing fiels constaint
  */


namespace TuringTest\Form\Field\Symfony\Constraint;


use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class Turing extends Constraint{

    public $message = 'Votre réponse à la question de sécurité est erronée.';

    public $container = null;

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}