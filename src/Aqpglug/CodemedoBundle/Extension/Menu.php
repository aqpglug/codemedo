<?php

namespace Aqpglug\CodemedoBundle\Extension;

use \Twig_Extension;
use \Twig_Function_Method;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Aqpglug\CodemedoBundle\Extension\Config;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;

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
        if(!$this->isValid()) throw new \InvalidArgumentException();
    }

    public function isValid()
    {
        foreach($this->menu as $menu) foreach($menu as $item) if(is_array($item)) if(!array_key_exists('url', $item)) return false;
        return true;
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
        $menu = $params = array();
        $url = $label = "";
        
        foreach($this->menu[$menu_id] ? : array() as $label => $options)
        {
            if(is_array($options))
            {
                // configuracion tipo array
                $url = $options['url'];
                // campos opcionales
                $params = isset($options['params']) ? $options['params'] : array();
                $label = isset($options['label']) ? $options['label'] : $label;
            }
            else
            {
                // url directa
                $url = $options;
            }
            
            if($this->isExternalUrl($url))
            {
                $route = $url;
            }
            else
            {
                if(!$route = $this->generateRoute($url, $params))
                    continue;
            }
            
            $menu[$label] = $route;
        }
        return $menu;
    }
    
    private function isExternalUrl($url)
    {
        $regexp = "@^https?://@i";
        return preg_match($regexp, $url);
    }
    
    private function generateRoute($url, array $params)
    {
        try
        {
            $route = $this->router->generate($url, $params);
        }
        catch(RouteNotFoundException $ex)
        {
            return false;
        }
        catch(MissingMandatoryParametersException $ex)
        {
            return false;
        }
        return $route;
    }

    public function getMenu($menu_id, $attr)
    {
        $menu_str = "<ul %s>%s</ul>";
        $link_str = "<li><a href=\"%s\" >%s</a></li>";

        $menu = "";

        foreach($this->getMenuArray($menu_id) as $label => $url)
        {
            $menu .= sprintf($link_str, $url, $label);
        }

        $attrs = "";

        foreach($attr as $key => $value)
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
