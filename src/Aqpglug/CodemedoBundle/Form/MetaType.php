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
            if (is_string($key)) {
                $options = array('required' => false);
                if ($value == "datetime") {
                    $options['years'] = range(date('Y'), date('Y') + 5);
                    $options['empty_value'] = '';
                    $options['minutes'] = range(0,59,15);
                }
                $builder->add($key, $value ?: 'text', $options);
            }
            else
                $builder->add($value);
        }
    }

    public function getName()
    {
        return 'meta';
    }
}
