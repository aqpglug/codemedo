<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{

    public function featuredAction($field, $template, $limit=5)
    {
        //$blocks = $this->getRepo()->findAllSortedBy($field, $limit);
        $blocks = $this->getRepo()->findBy(
                array('type' => $field,
                    'published' => True,
                    'featured' => True),
                array(
                    'created' => 'DESC'
                ), $limit);

        return $this->render($template, array(
            'results' => $blocks,
        ));
    }

}
