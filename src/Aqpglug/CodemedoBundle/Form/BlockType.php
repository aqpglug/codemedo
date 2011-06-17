<?php

namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BlockType extends AbstractType
{

    // TODO: traer esto desde el config
    protected $labels;
    protected $meta;

    function __construct($labels, $meta)
    {
        $this->labels = $labels;
        $this->meta = $meta;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type', 'choice', array('choices' => $this->labels))
                ->add('title')
                ->add('slug', 'text', array(
                    'required' => false,
                ))
                ->add('content')
                ->add('published', 'checkbox', array(
                    'required' => false,
                ))
                ->add('featured', 'checkbox', array(
                    'required' => false,
                ));
    }

}
