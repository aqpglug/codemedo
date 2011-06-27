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
        $criteria = array('type' => $this->type, 'published' => true);

        $featured = $this->getRepo()->findOnePublishedBy(array_merge(array('featured' => true), $criteria));

        $step = ($featured !== null) ? 2 : 3;
        $pages = $this->countPagesBy($criteria, $step);

        $query = $this->getRepo()->createQueryBuilder('b')
                ->select('b.title, b.image, b.metadata, b.slug')
                ->where('b.type = ?1')
                ->andWhere('b.published = true')
                ->setParameter(1, $this->type)
                ->orderBy('b.created', 'DESC')
                ->setMaxResults($step)
                ->setFirstResult($step * ($page - 1));
        if($featured !== null)
        {
            $query
                ->andWhere('b.id != ?2')
                ->setParameter(2, $featured->getId());
        }
        $articles = $query->getQuery()->execute();

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
        $article = $this->getRepo()->findOnePublishedBy(array(
                    'type' => 'article',
                    'slug' => $slug));

        return $this->render('AqpglugCodemedoBundle:Article:show.html.twig', array(
            'article' => $article,
        ));
    }
}
