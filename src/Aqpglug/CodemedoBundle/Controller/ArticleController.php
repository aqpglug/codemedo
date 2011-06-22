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
    private $type = 'article';
    /**
     * @Route("/{page}", name="_article_index", defaults={"page"=1}, requirements={"page"="\d+"})
     */
    public function indexAction($page)
    {
        $step = 4;
        $count = $this->getRepo()->countBy(array(
            'type' => $this->type,
            'published' => True,
            'featured' => false,));
        $pages = ceil($count / $step);

        $articles = $this->getRepo()->findPublishedBy(
                array('type' => $this->type,
                      'featured' => False),
                array('created'=> 'DESC',), $step, $step * ($page - 1));

        return $this->render('AqpglugCodemedoBundle:Article:index.html.twig', array(
            'articles' => $articles,
            'page' => $page,
            'pages' => $pages,
        ));
    }

    /**
     * @Route("/{slug}", name="_article_show")
     */
    public function showAction($slug)
    {
        $article = $this->getRepo()->findOnePublished(array(
            'type' =>'article',

            'slug'=> $slug));

        return $this->render('AqpglugCodemedoBundle:Article:show.html.twig', array(
            'article' => $article,
        ));
    }

}
