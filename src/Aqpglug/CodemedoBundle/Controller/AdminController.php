<?php

namespace Aqpglug\CodemedoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Aqpglug\CodemedoBundle\Controller\Controller;
use Aqpglug\CodemedoBundle\Entity\Block;
use Aqpglug\CodemedoBundle\Form\BlockType;

/**
 * @Route("/admin")
 * @Secure(roles="ROLE_ADMIN")
 */
class AdminController extends Controller
{

    /**
     * @Route("/login", name="_demo_login")
     */
    public function loginAction()
    {
        if($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AqpglugCodemedoBundle:Admin:login.html.twig', array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        ));
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/", name="_admin")
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
     * @Route("/list/{type}/{page}", name="_admin_list", defaults={"page"=1})
     */
    public function listAction($type, $page)
    {
        $step = 13;
        $pages = $this->countPagesBy(array('type' => $type), $step);

        $blocks = $this->getRepo()->findBy(
                        array('type' => $type,), array('created' => 'DESC',), $step, $step * ($page - 1));
        
        // Algun bug en la session no borra la flash
        $this->getRequest()->getSession()->removeFlash('notice');
        if(!count($blocks))
            $this->getRequest()->getSession()->setFlash('notice', sprintf("no hay %ss", $this->getConfig()->getLabel($type)));

        return $this->render('AqpglugCodemedoBundle:Admin:list.html.twig', array(
            'blocks' => $blocks,
            'type' => $type,
            'page' => $page,
            'pages' => $pages,
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
        if($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if($form->isValid())
            {
                $block->autoslug();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($block);
                $em->flush();
                return $this->redirect($this->generateUrl('_admin_list', array('type' => $block->getType())));
            }
        }

        return $this->render('AqpglugCodemedoBundle:Admin:form.html.twig', array(
            'form' => $form->createView(),
            'form_action' => $this->generateUrl('_admin_edit', array('id' => $id)),
            'type' => $block->getType(),
        ));
    }

    /**
     * @Route("/{type}/new", name="_admin_new")
     */
    public function newAction($type)
    {
        $block = new Block();
        $block->setPublished(true);

        $meta = $this->get('codemedo')->getMeta($type);
        $form = $this->createForm(new BlockType($meta), $block);

        $request = $this->getRequest();
        if($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if($form->isValid())
            {
                print_r($form['image']); die();
                $block->setImage($this->saveImage($form['image'], md5(time()), $type));
                $block->autoslug();
                $block->setType($type);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($block);
                $em->flush();
                return $this->redirect($this->generateUrl(
                                '_admin_list', array('type' => $block->getType())));
            }
        }

        return $this->render('AqpglugCodemedoBundle:Admin:form.html.twig', array(
            'form' => $form->createView(),
            'form_action' => $this->generateUrl('_admin_new', array('type' => $type)),
            'type' => $type,
        ));
    }

    /**
     * @Route("/remove/{id}", name="_admin_remove", requirements={"_method"="POST"})
     */
    public function removeAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));
        $type = $block->getType();
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($block);
        $em->flush();
        return $this->redirect($this->generateUrl('_admin_list', array('type' => $type)));
    }
    
    /**
     * @Route("/publish/{id}", name="_admin_publish")
     */
    public function publishAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));
        $block->setPublished(!$block->getPublished());
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($block);
        $em->flush();
        return $this->redirect($this->generateUrl('_admin_list', array('type' => $block->getType())));
    }
    
    /**
     * @Route("/feature/{id}", name="_admin_feature")
     */
    public function featureAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));
        $block->setFeatured(!$block->getFeatured());
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($block);
        $em->flush();
        return $this->redirect($this->generateUrl('_admin_list', array('type' => $block->getType())));
    }
    
    /**
     * @Route("/preview/{id}", name="_admin_preview")
     */
    public function previewAction($id)
    {
        $block = $this->getRepo()->findOneBy(array('id' => $id));
        
        try
        {
            $route = $this->generateUrl('_'.$block->getType().'_show', array('slug' => $block->getSlug()));
        }
        catch(\Symfony\Component\Routing\Exception\RouteNotFoundException $exc)
        {
            $this->getRequest()->getSession()->setFlash('notice', 'no se puede previsualizar');
            $route = $this->getRequest()->headers->get('referer');
        }
        return $this->redirect($route);
    }
    
    private function saveImage(UploadedFile $file, $name, $type)
    {
        $extension = $file->guessExtension();
        if (!$extension) {
            // extension cannot be guessed
            $extension = 'bin';
        }
        $webroot = $this->getRequest()->server['DOCUMENT_ROOT'];
        $dir = 'images'.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR;
        $file->move($webroot.DIRECTORY_SEPARATOR.$dir, $name.'.'.$extension);
        return $dir.DIRECTORY_SEPARATOR.$name.'.'.$extension;
    }
}
