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
        $step = 12;
        $count = $this->getRepo()->countBy(array(
                    'type' => $this->type,
                    'published' => True,));
        $pages = ceil($count / $step);

        $members = $this->getRepo()->findBy(
                array('type' => $this->type,
                      'published' => True,),
                array('featured' => 'DESC',
                      'created' => 'DESC',), $step, $step * ($page - 1));

        return $this->render('AqpglugCodemedoBundle:Member:index.html.twig', array(
            'members' => $members,
            'page' => $page,
            'pages' => $pages,
        ));
    }

}
