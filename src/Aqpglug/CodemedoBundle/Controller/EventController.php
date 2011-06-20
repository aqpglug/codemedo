<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Aqpglug\CodemedoBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/eventos")
 */
class EventController extends Controller
{

    /**
     * @Route("/", name="_event_index")
     */
    public function indexAction()
    {
        $events = $this->getRepo()->findAllSortedBy('event', 'created');

        return $this->render('AqpglugCodemedoBundle:Event:index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * @Route("/{slug}", name="_event_show")
     */
    public function showAction($slug)
    {
        $event = $this->getRepo()->findOneBy(array(
            'type' =>'event',
            'slug'=> $slug));
        
        return $this->render('AqpglugCodemedoBundle:Event:show.html.twig', array(
            'event' => $event,
            ));
    }

}
