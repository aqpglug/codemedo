<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/")
 */
class PageController extends Controller
{

    /**
     * @Route("", name="homepage")
     */
    public function indexAction()
    {
        $homepage_id = 1; // TODO: traer de config

        $page = $this->getRepo()->getHome($homepage_id);

        if (!$page) {
            $this->createNotFoundException();
        }

        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }

    /**
     * @Route("{slug}", name="_page_show")
     */
    public function showAction($slug)
    {
        $page = $this->getRepo()->findPageBySlug($slug);
        
        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }

}
