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
     * @Route("/{page}", name="_article", defaults={"page"=1}, requirements={"page"="\d+"})
     */
    public function indexAction($page)
    {
        $featured = $this->getRepo()->findPublishedBy(
                        array('type' => $this->type,
                    'featured' => True), array('created' => 'DESC'), 3);

        $step = (count($featured)) ? 4 : 6;

        $pages = $this->countPagesBy(array(
                    'type' => $this->type,
                    'published' => True,
                    'featured' => false,), $step);

        $articles = $this->getRepo()->findPublishedBy(
                        array('type' => $this->type,
                    'featured' => False), array('created' => 'DESC',), $step, $step * ($page - 1));

        return $this->render('AqpglugCodemedoBundle:Article:index.html.twig', array(
            'articles' => $articles,
            'featured' => $featured,
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
                    'type' => 'article',
                    'slug' => $slug));

        return $this->render('AqpglugCodemedoBundle:Article:show.html.twig', array(
            'article' => $article,
        ));
    }
}
