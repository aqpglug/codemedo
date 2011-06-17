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
            'id' => $id));
    }

    public function findPageBySlug($slug)
    {
        return $this->findOneBy(array(
            'type' => 'page',
            'slug' => $slug,
            'published' => True));
    }

    public function findAllSortedBy($type, $field, $nb = null)
    {
        $query = $this->queryAllSortedBy($type, $field);

        if (null !== $nb) {
            $query->setMaxResults($nb);
        }

        return $query->execute();
    }

    public function queryAllSortedBy($type, $field)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.type = ?1');
        $qb->andWhere('e.published = ?2');
        $qb->setParameters(array(
            1 => $type,
            2 => true,
        ));
        $qb->orderBy('e.' . $field, 'title' === $field ? 'asc' : 'desc');
        $query = $qb->getQuery();

        return $query;
    }

}