<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class PageController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AqpglugCodemedoBundle:Page:index.html.twig');
    }

    /**
     * @Route("/{slug}", name="_Page_show")
     */
    public function showAction($slug)
    {
        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig');
    }

}
