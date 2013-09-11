<?php

/**
 * Created By Johan Nagou
 * Date : 2013-06-14
 *
 * Turing field validator.
 */


namespace TuringTest\Form\Field\Symfony\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TuringValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $answer = $constraint->container['session']->get('turing');
         if (!empty($value) && $value != $answer) {
              $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}