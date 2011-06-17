<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{
    public function listAction($type, $field, $template, $limit=5)
    {
        $blocks = $this->getRepo()->findAllSortedBy($type, $field, $limit);

        return $this->render($template, array(
            'results' => $blocks,
        ));
    }
}
