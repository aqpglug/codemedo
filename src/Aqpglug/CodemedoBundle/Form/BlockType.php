<?php
namespace Aqpglug\CodemedoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BlockType extends AbstractType
{
    // TODO: traer esto desde el config
    public $types = array(
        'page' => 'Página',
        'article' => 'Artículo',
        'project' => 'Proyecto',
        'event' => 'Evento',
        'member' => 'Miembro',
    );

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type', 'choice', array('choices' => $this->types))
                ->add('title')
                ->add('slug')
                ->add('content');
    }
}
