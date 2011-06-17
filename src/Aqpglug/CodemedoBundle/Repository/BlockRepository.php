<?php

namespace Aqpglug\CodemedoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Aqpglug\CodemedoBundle\Entity\Block;

class BlockRepository extends EntityRepository
{

    public function getHome($id)
    {
        return $this->findBy(array(
            'type' => 'page',
            'id' => $id ));
    }
    
    public function findPageBySlug($slug)
    {
        return $this->findBy(array(
            'type' => 'page',
            'slug' => $slug ));
    }
}