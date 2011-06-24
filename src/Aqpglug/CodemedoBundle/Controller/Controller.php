<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Base_Controller;
use Aqpglug\CodemedoBundle\Repository\BlockRepository;
use Aqpglug\CodemedoBundle\Extension\Config;

class Controller extends Base_Controller
{

    /**
     * @return BlockRepository
     */
    public function getRepo()
    {
        return $this->getDoctrine()->getRepository('Aqpglug\CodemedoBundle\Entity\Block');
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->get('codemedo');
    }

    public function countPagesBy(array $criteria, $step = 10)
    {
        $count = $this->getRepo()->countBy($criteria);
        return ceil($count / $step);
    }
}
