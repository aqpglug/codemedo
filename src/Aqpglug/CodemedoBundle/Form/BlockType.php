<?php
namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BlockType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type')
                ->add('title')
                ->add('content');
    }
}
