<?php

namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BlockType extends AbstractType
{

    // TODO: traer esto desde el config
    protected $types;

    function __construct($types)
    {
        $this->types = $types;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type', 'choice', array('choices' => $this->types))
                ->add('title')
                ->add('slug')
                ->add('content')
                ->add('published', 'checkbox', array(
                    'required' => false,
                ))
                ->add('featured', 'checkbox', array(
                    'required' => false,
                ));
    }

}
