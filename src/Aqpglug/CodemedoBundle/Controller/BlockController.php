<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{

    /**
     * @Route("/", name="_home")
     */
    public function homeAction()
    {
        return $this->render('AqpglugCodemedoBundle:Default:index.html.twig');
    }

    public function articlesAction()
    {
        
    }

}
