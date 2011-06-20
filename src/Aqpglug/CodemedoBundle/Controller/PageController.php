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
        $homepage = $this->getConfig()->getHome();
        
        $page = $this->getRepo()->findPageBySlug($homepage);
        
        if ($page === null) {
            throw $this->createNotFoundException("si no hay inicio, es el fin\n pagina de inicio no valida");
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
            throw $this->createNotFoundException(sprintf("Pagina %s no encontrada", $slug));
        }

        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }
}
