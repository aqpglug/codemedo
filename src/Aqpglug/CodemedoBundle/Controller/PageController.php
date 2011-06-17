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
        $homepage_id = 1; // TODO: traer de config

        $repo = $this->getDoctrine()->getRepository('Aqpglug\CodemedoBundle\Entity\Block');

        $page = $repo->getHome($homepage_id);

        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }

    /**
     * @Route("{slug}", name="_page_show")
     */
    public function showAction($slug)
    {
        $repo = $this->getDoctrine()->getRepository('Aqpglug\CodemedoBundle\Entity\Block');

        $page = $repo->findPageBySlug($slug);
        return $this->render('AqpglugCodemedoBundle:Page:show.html.twig', array(
            'page' => $page,
        ));
    }

}
