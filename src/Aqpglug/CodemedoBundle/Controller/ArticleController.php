<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
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
        $featured = $this->getRepo()->findAllSortedBy('article', 'featured', 3);
        $articles = $this->getRepo()->findAllSortedBy('article', 'created');

        return $this->render('AqpglugCodemedoBundle:Article:index.html.twig', array(
            'featured' => $featured,
            'articles' => $articles,
            ));
    }

    /**
     * @Route("/{slug}", name="_article_show")
     */
    public function showAction($slug)
    {
        return $this->render('AqpglugCodemedoBundle:Article:show.html.twig');
    }
}
