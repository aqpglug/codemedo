<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/articulos")
 */
class ArticleController extends Controller
{

    /**
     * @Route("/", name="_article_index")
     */
    public function indexAction()
    {
        return $this->render('AqpglugCodemedoBundle:Article:index.html.twig');
    }

    /**
     * @Route("/{slug}", name="_article_show")
     */
    public function articlesAction($slug)
    {
        return $this->render('AqpglugCodemedoBundle:Article:show.html.twig');
    }

}
