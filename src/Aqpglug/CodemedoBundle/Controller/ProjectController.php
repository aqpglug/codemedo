<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/proyectos")
 */
class ProjectController extends Controller
{

    /**
     * @Route("/", name="_project")
     */
    public function indexAction()
    {
        //$projects = $this->getRepo()->findAllSortedBy('project', 'created', 4);
        $projects = $this->getRepo()->findBy(
                array('type' => 'project'),
                array('created' => 'DESC'),
                4);
        
        return $this->render('AqpglugCodemedoBundle:Project:index.html.twig', array(
            'projects' => $projects,
        ));
    }

    /**
     * @Route("/{slug}", name="_project_show")
     */
    public function showAction($slug)
    {
        return $this->render('AqpglugCodemedoBundle:Project:show.html.twig');
    }

}
