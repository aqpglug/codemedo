<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Aqpglug\CodemedoBundle\Controller\Controller;
use Aqpglug\CodemedoBundle\Entity\Block;
use Aqpglug\CodemedoBundle\Form\BlockType;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{

    /**
     * @Route("/", name="_admin_index")
     */
    public function indexAction()
    {
        $articles = $this->getRepo()->findBy(array(),array(
            'type' => 'ASC',
            'created' => 'DESC',
        ));
        
        return $this->render('AqpglugCodemedoBundle:Admin:index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * @Route("/new", name="_admin_new")
     */
    public function newAction()
    {
        $block = new Block();
        $types = $this->get('codemedo')->getTypes();
        $form = $this->createForm(new BlockType($types), $block);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($block);
                $em->flush();
                return $this->redirect($this->generateUrl('_admin_index'));
            }
        }

        return $this->render('AqpglugCodemedoBundle:Admin:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/edit/{id}", name="_admin_edit")
     */
    public function editAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));
        
        $form = $this->createForm(new BlockType(), $block);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($block);
                $em->flush();
                return $this->redirect($this->generateUrl('_admin_index'));
            }
        }

        return $this->render('AqpglugCodemedoBundle:Admin:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
        ));
    }
    
    
}
