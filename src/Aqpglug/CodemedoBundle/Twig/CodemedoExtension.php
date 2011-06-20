<?php

namespace Aqpglug\CodemedoBundle\Twig;

use \Twig_Extension;
use \Twig_Function_Method;
use Aqpglug\CodemedoBundle\Extension\Config;

class CodemedoExtension extends Twig_Extension
{
    protected $config;
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    public function getFunctions()
    {
        return array(
            'get_types' => new Twig_Function_Method($this, 'getTypes'),
        );
    }
    public function getTypes()
    {
        return $this->config->getTypes();
    }
    public function getName()
    {
        return 'codemedo_twig';
    }
}
