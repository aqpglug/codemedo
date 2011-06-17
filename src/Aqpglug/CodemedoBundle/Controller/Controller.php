<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Base_Controller;
use Aqpglug\CodemedoBundle\Repository\BlockRepository;

class Controller extends Base_Controller
{
    /**
     * @return BlockRepository
     */
    public function getRepo()
    {
        return $this->getDoctrine()->getRepository('Aqpglug\CodemedoBundle\Entity\Block');
    }
}
