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

    /**
     * @Route("/", name="_member_index")
     */
    public function indexAction()
    {
        $members = $this->getRepo()->findBy(
                array('type' => 'member',
                    'published' => True),
                array('featured' => 'DESC',
                    'created' => 'DESC'));
        return $this->render('AqpglugCodemedoBundle:Member:index.html.twig', array(
            'members' => $members,
        ));
    }
}
