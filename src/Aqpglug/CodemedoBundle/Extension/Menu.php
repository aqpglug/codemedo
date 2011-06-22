<?php

namespace Aqpglug\CodemedoBundle\Extension;

use \Twig_Extension;
use \Twig_Function_Method;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Aqpglug\CodemedoBundle\Extension\Config;

class Menu extends Twig_Extension
{

    protected $config;
    protected $menu;
    protected $router;

    public function __construct(Config $config, Router $router)
    {
        $this->config = $config;
        $this->menu = $config->get('menu') ? : array();
        $this->router = $router;
    }

    public function getFunctions()
    {
        return array(
            'menu' => new Twig_Function_Method($this, 'getMenu', array('is_safe' => array('html'))),
            'menu_array' => new Twig_Function_Method($this, 'getMenuArray'),
        );
    }

    public function getMenuArray($menu_id)
    {
        $menu = array();
        foreach ($this->menu[$menu_id] ?: array() as $key => $value)
        {
            if(is_array($value))
                $route = $this->router->generate($value['url'], $value['params'] ?: array());
            else
                $route = $this->router->generate($value);
            $menu[$key] = $route;
        }
        return $menu;
    }

    public function getMenu($menu_id, $attr)
    {
        $menu_str   = "<ul %s>%s</ul>";
        $link_str   = "<li><a href=\"%s\" >%s</a></li>";
        
        $menu = "";

        foreach ($this->getMenuArray($menu_id) as $label => $url)
        {
            $menu .= sprintf($link_str, $url, $label);
        }
        
        $attrs = "";
        
        foreach ($attr as $key => $value)
        {
            $attrs .= sprintf(" %s=\"%s\" ", $key, $value);
        }
        
        return sprintf($menu_str, $attrs, $menu);
    }

    public function getName()
    {
        return 'codemedo_twig_menu';
    }
}
