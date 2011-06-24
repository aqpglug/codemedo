<?php

namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MetaType extends AbstractType
{

    protected $meta;

    function __construct(array $meta)
    {
        $this->meta = $meta;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        foreach ($this->meta as $key => $value)
        {
            if (is_string($key))
                $builder->add($key, $value ?: 'text', array('required' => false));
            else
                $builder->add($value);
        }
    }
}
