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
        $page = $this->getRepo()->getHome($this->getConfig()->getHome());

        if ($page === null) {
            throw $this->createNotFoundException(sprintf("Pagina no encontrada ", $slug));
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
        
        if ($page === null) {
            throw $this->createNotFoundException(sprintf("Pagina no encontrada ", $slug));
        }

        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }
}
