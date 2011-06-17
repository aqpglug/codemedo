<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        return $this->render('AqpglugCodemedoBundle:Member:index.html.twig');
    }
}
