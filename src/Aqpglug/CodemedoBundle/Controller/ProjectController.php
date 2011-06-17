<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/proyectos")
 */
class ProjectController extends Controller
{

    /**
     * @Route("/", name="_project_index")
     */
    public function indexAction()
    {
        return $this->render('AqpglugCodemedoBundle:Project:index.html.twig');
    }

    /**
     * @Route("/{slug}", name="_project_show")
     */
    public function showAction($slug)
    {
        return $this->render('AqpglugCodemedoBundle:Project:show.html.twig');
    }

}
