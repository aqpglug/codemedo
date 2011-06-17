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
        return array_keys($this->data['types']);
    }

    public function getMeta($type)
    {
        return $this->types[$type];
    }

    public function getHome()
    {
        return;
    }
}
