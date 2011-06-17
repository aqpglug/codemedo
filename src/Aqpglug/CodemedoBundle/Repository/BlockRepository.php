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
            'id' => $id));
    }

    public function findPageBySlug($slug)
    {
        return $this->findBy(array(
            'type' => 'page',
            'slug' => $slug));
    }

    public function findAllSortedBy($type, $field, $nb = null)
    {
        $query = $this->queryAllSortedBy($field);

        if (null !== $nb) {
            $query->setMaxResults($nb);
        }

        return $query->execute();
    }

    public function queryAllSortedBy($type, $field)
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.type = ?', $type);
        $qb->andWhere('e.published = ?', true);
        $qb->orderBy('e.' . $field, 'title' === $field ? 'asc' : 'desc');
        $query = $qb->getQuery();

        return $query;
    }
}