<?php

namespace Aqpglug\CodemedoBundle\Extension;

use \Twig_Extension;
use \Twig_Function_Method;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Aqpglug\CodemedoBundle\Extension\Config;

class Menu extends Twig_Extension
{

    protected $config;
    protected $menu;
    protected $router;
    protected $session;

    public function __construct(Config $config, Router $router, Session $session)
    {
        $this->config = $config;
        $this->router = $router;
        $this->session = $session;

        $this->menu = $config->get('menu') ? : array();
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
        $menu = $params = $attrs = array();
        $url = $label = "";

        foreach($this->menu[$menu_id] ? : array() as $label => $options)
        {
            if(is_array($options))
            {
                // configuracion tipo array
                if(!array_key_exists('url', $options))
                {
                    $this->session->setFlash('error', sprintf("menu error: parametro url requerido: %s => %s", $menu_id, $label));
                    continue;
                }
                $url = $options['url'];
                // campos opcionales
                $params = isset($options['params']) ? $options['params'] : array();
                $label = isset($options['label']) ? $options['label'] : $label;
                $attrs = isset($options['attrs']) ? $options['attrs'] : array();
            }
            else
            {
                // url directa
                $url = $options;
            }

            if($this->isExternalUrl($url))
            {
                $route = $url;
                $attrs = array_merge(array('target' => '_blank'), $attrs);
            }
            else
            {
                if(!$route = $this->generateRoute($url, $params)) continue;
            }

            $menu[$label] = array(
                'url' => $route,
                'label' => $label,
                'attrs' => $attrs,
            );
            $params = $attrs = array();
            $url = $label = "";
        }
        return $menu;
    }

    private function isExternalUrl($url)
    {
        $regexp = "@^https?://@i";
        return preg_match($regexp, $url);
    }
    
    public function isValid($item)
    {
        if(is_array($item))
            
        return true;
    }

    private function generateRoute($url, array $params)
    {
        try
        {
            $route = $this->router->generate($url, $params);
        }
        catch(RouteNotFoundException $ex)
        {
            $this->session->setFlash('error', sprintf("menu error: no existe la ruta %s", $url));
            return false;
        }
        catch(MissingMandatoryParametersException $ex)
        {
            $this->session->setFlash('error', sprintf("menu error: la ruta %s requiere mas parametros", $url));
            return false;
        }
        return $route;
    }

    public function getMenu($menu_id, array $attrs = array())
    {
        $menu_str = "<ul %s>%s</ul>";
        $link_str = "<li><a href=\"%s\" %s>%s</a></li>";

        $menu = "";

        foreach($this->getMenuArray($menu_id) as $label => $params)
        {
            $menu .= sprintf($link_str, $params['url'], $this->getAttrs($params['attrs']), $label);
        }

        return sprintf($menu_str, $this->getAttrs($attrs), $menu);
    }

    public function getAttrs(array $attrs = array())
    {
        $str = "";
        foreach($attrs as $key => $value)
        {
            $str .= sprintf(" %s=\"%s\" ", $key, $value);
        }
        return $str;
    }

    public function getName()
    {
        return 'codemedo_twig_menu';
    }
}
