<?php

namespace Aqpglug\CodemedoBundle\Extension;

use \Twig_Extension;
use \Twig_Function_Method;
use Aqpglug\CodemedoBundle\Extension\Config;

class Twig extends Twig_Extension
{
    protected $config;
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    public function getGlobals()
    {
        return array(
            'get_types' => $this->getTypes(),
            'get_labels' => $this->getLabels(),
        );
    }
    public function getTypes()
    {
        return $this->config->getTypes();
    }
    public function getLabels()
    {
        return $this->config->getLabels();
    }
    public function getName()
    {
        return 'codemedo_twig';
    }
}
