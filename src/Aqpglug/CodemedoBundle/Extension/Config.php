<?php

namespace Aqpglug\CodemedoBundle\Extension;

use Symfony\Component\Yaml\Yaml;

class Config
{

    protected $data;

    public function __construct()
    {
        $this->data = Yaml::parse(__DIR__ . "/../Resources/config/codemedo.yml");
        $keys = array_keys($this->data);

        if (count(array_diff($keys, array('homepage', 'types'))))
            throw new \InvalidArgumentException("configuración no valida, debe tener 'homepage' y 'types'");

        foreach ($this->data['types'] as $key => $value) {
            if (!array_key_exists('label', $value)) {
                throw new \InvalidArgumentException("configuración no valida, los 'types' necesitan un campo 'label'");
            }
        }
    }

    public function getTypes()
    {
        return $this->data['types'];
    }

    public function getLabels()
    {
        $labels = array();
        foreach ($this->data['types'] as $key => $value) {
            $labels[$key] = $value['label'];
        }
        return $labels;
    }

    public function getMeta($type = null)
    {
        if(in_array($type, $this->getTypes()))
            throw new \InvalidArgumentException();
        
        $meta = $this->data['types'];
        foreach ($meta as $key => $value) {
            $meta[$key] = array_key_exists('metadata', $value) ? $value['metadata'] : array();
        }
        
        if($type !== null)
            return $meta[$type];
        return $meta;
    }

    public function getHome()
    {
        return $this->data['homepage'];
    }

}
