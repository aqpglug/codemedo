<?php

namespace Aqpglug\CodemedoBundle\Twig;

use \Twig_Extension;
use \Twig_Function_Method;
use Aqpglug\CodemedoBundle\Extension\Config as CmdConfig;

class Config extends Twig_Extension
{

    protected $config;

    public function __construct(CmdConfig $config)
    {
        $this->config = $config;
    }

    public function getGlobals()
    {
        return array(
            'get_types' => $this->getTypes(),
            'get_labels' => $this->getLabels(),
            'get_home' => $this->getHome(),
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

    public function getHome()
    {
        return $this->config->getHome();
    }

    public function getName()
    {
        return 'codemedo.twig.config';
    }
}
