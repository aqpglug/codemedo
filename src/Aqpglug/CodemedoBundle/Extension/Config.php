<?php

namespace Aqpglug\CodemedoBundle\Extension;

use Symfony\Component\Yaml\Yaml;

class Config
{
    protected $data;
    public function __construct()
    {
        $base_config = array_values(array('homepage', 'types'));
        $base_types = array('page' => array('label' => 'Página'));

        $this->data = Yaml::parse(__DIR__ . "/../Resources/config/codemedo.yml");

        $keys = array_keys($this->data);

        if (array_values(array_intersect($keys, $base_config)) !== $base_config)
            throw new \InvalidArgumentException();

        $this->data['types'] = array_merge($base_types, $this->data['types'] ? : array());

        foreach ($this->data['types'] as $value) {
            if (!array_key_exists('label', $value ? : array())) {
                throw new \InvalidArgumentException();
            }
        }
    }
    public function get($config)
    {
        return $this->data[$config] ? : array();
    }
    public function getHome()
    {
        return $this->get('homepage');
    }
    public function getTypes()
    {
        return $this->get('types');
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
        if (in_array($type, $this->getTypes()))
            throw new \InvalidArgumentException();

        $meta = $this->data['types'];
        foreach ($meta as $key => $value) {
            $meta[$key] = array_key_exists('metadata', $value) ? $value['metadata'] : array();
        }

        if ($type !== null)
            return $meta[$type];
        return $meta;
    }
}
