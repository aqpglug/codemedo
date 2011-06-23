<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/miembros")
 */
class MemberController extends Controller
{
    private $type = 'member';
    /**
     * @Route("/{page}", name="_member", defaults={"page"=1}, requirements={"page"="\d+"})
     */
    public function indexAction($page)
    {
        $step = 6;
        $count = $this->getRepo()->countBy(array(
                    'type' => $this->type,
                    'featured' => false,
                    'published' => True,));
        $pages = ceil($count / $step);

        $members = $this->getRepo()->findBy(
                array('type' => $this->type,
                      'featured' => false,
                      'published' => True,),
                array('created' => 'ASC',), $step, $step * ($page - 1));

        return $this->render('AqpglugCodemedoBundle:Member:index.html.twig', array(
            'members' => $members,
            'page' => $page,
            'pages' => $pages,
        ));
    }
    
    public function activeAction()
    {
        $members = $this->getRepo()->findPublishedBy(
                array('type' => $this->type,
                    'featured' => True),
                array('created' => 'ASC'), 9);

        return $this->render('AqpglugCodemedoBundle:Member:active.html.twig', array(
            'members' => $members,
        ));
    }
}
