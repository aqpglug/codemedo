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
        
        if(count(array_diff($keys, array('homepage', 'types'))))
            throw new \InvalidArgumentException();
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

    public function getMeta($type)
    {
        $meta = array();
        foreach ($this->data['types'] as $key => $value) {
            $labels[$key] = $value['metadata'];
        }
        return $this->types[$type];
    }

    public function getHome()
    {
        return;
    }
}
