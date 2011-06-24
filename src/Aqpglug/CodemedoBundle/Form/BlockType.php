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
        $builder->add('content','textarea', array(
                    'label' => 'Contenido',
                    'required' => false,
                    'attr' => array('class' => 'content')
                ))
                ->add('title','text', array(
                    'label' => 'Título',
                    'attr' => array('autofocus' => 'autofocus'),
                ))
                ->add('slug', 'text', array(
                    'required' => false,
                ))
                ->add('published', 'checkbox', array(
                    'label' => 'Publicado',
                    'required' => false,
                ))
                ->add('featured', 'checkbox', array(
                    'label' => 'Destacado',
                    'required' => false,
                ))
                ->add('image', 'file', array(
                    'label' => 'Imágen',
                    'required' => false,
                ));
        if ($this->meta !== array()) $builder->add('metadata', new MetaType($this->meta));
    }
}
