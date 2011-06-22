<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{

    public function featuredAction($type, $template, $limit=5, $page=1)
    {
        $blocks = $this->getRepo()->findPublishedBy(
                array('type' => $type,
                    'featured' => True),
                array('created' => 'DESC'), $limit);

        return $this->render($template, array(
            'results' => $blocks,
        ));
    }

    public function listAction($type, $field, $template, $limit=5)
    {
        $blocks = $this->getRepo()->findAllSortedBy($type, $field, $limit);

        return $this->render($template, array(
            'results' => $blocks,
        ));
    }

}
