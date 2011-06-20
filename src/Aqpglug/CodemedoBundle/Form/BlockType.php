<?php

namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Aqpglug\CodemedoBundle\Form\MetaType;
use Aqpglug\CodemedoBundle\Extension\Config;

class BlockType extends AbstractType
{
    private $meta;
    function __construct($meta)
    {
        $this->meta = $meta;
    }
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('title')
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
        if($this->meta !== array())
            $builder->add('metadata', new MetaType($this->meta));
    }
}
