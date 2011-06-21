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
        $articles = $this->getRepo()->findBy(array(), array(
                    'type' => 'ASC',
                    'created' => 'DESC',
                ));

        return $this->render('AqpglugCodemedoBundle:Admin:index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * @Route("/{type}/{page}", name="_admin_list", defaults={"page"=1})
     */
    public function listAction($type, $page)
    {
        $qb = $this->getRepo()->createQueryBuilder('b');
        $qb->add('select', $qb->expr()->count('b.id'))
           ->where('b.type = ?1')
           ->setParameter(1, $type);
        $count = $qb->getQuery()->getSingleScalarResult();
        
        $step = 2;
        $pages = ceil($count / $step);
        $blocks = $this->getRepo()->findBy(
                array('type' => $type,),
                array('created' => 'DESC',), $step, $step * ($page -1));
        return $this->render('AqpglugCodemedoBundle:Admin:list.html.twig', array(
            'blocks' => $blocks,
            'type' => $type,
            'page' => $page,
            'pages' => $pages,
        ));
    }

    /**
     * @Route("/{type}/new", name="_admin_new")
     */
    public function newAction($type)
    {
        $block = new Block();

        $meta = $this->get('codemedo')->getMeta($type);
        $form = $this->createForm(new BlockType($meta), $block);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $block->setType($type);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($block);
                $em->flush();
                return $this->redirect($this->generateUrl('_admin_index'));
            }
        }

        return $this->render('AqpglugCodemedoBundle:Admin:new.html.twig', array(
            'form' => $form->createView(),
            'type' => $type,
        ));
    }

    /**
     * @Route("/edit/{id}", name="_admin_edit")
     */
    public function editAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));

        $meta = $this->get('codemedo')->getMeta($block->getType());
        $form = $this->createForm(new BlockType($meta), $block);

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
