<?php

/**
 * Form Field Turing
 *
 * Author: Johan Nagou
 * Date: 2013-05-31
 */

namespace TuringTest\Form\Field\Symfony;

use TuringTest\Form\Field\IField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Validator\Util\ServerParams;

/**
 * Class Turing
 * @package TuringTest\Form\Field\Symfony
 * @author Johan Nagou
 */
class Turing extends AbstractType implements IField
{

    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(
        FormView $view,
        FormInterface $form,
        array $options
    ) {
        // Generate question ( and keep result into session
        // when also display form
        $view->vars['label'] = $this->container['turing']->generateQuestion();
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'turing';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * Get the container
     *
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

}