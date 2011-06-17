<?php

namespace Aqpglug\CodemedoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Aqpglug\CodemedoBundle\Entity\Block;

class BlockRepository extends EntityRepository
{

    public function getHome($id)
    {
        return $this->findOneBy(array(
            'type' => 'page',
            'id' => $id ));
    }
    
    public function findPageBySlug($slug)
    {
        return $this->findOneBy(array(
            'type' => 'page',
            'slug' => $slug,
            'published' => True));
    }
}