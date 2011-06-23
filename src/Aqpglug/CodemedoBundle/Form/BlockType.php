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
        $builder->add('title','text', array(
                    'label' => 'Título',
                ))
                ->add('slug', 'text', array(
                    'required' => false,
                ))
                ->add('content','textarea', array(
                    'label' => 'Contenido',
                ))
                ->add('published', 'checkbox', array(
                    'label' => 'Publicado',
                    'required' => false,
                ))
                ->add('featured', 'checkbox', array(
                    'label' => 'Destacado',
                    'required' => false,
                ));
        if ($this->meta !== array()) $builder->add('metadata', new MetaType($this->meta));
    }
}
