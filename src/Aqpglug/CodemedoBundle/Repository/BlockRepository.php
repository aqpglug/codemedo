<?php

namespace Aqpglug\CodemedoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Aqpglug\CodemedoBundle\Entity\Block;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlockRepository extends EntityRepository
{
    
    public function findOnePublishedBy(array $criteria)
    {
        $criteria = array_merge($criteria, array('published' => True));
        return $this->findOneBy($criteria);
    }
    
    public function findPublishedBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $criteria = array_merge($criteria, array('published' => True));
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    public function countBy(array $criteria)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->add('select', $qb->expr()->count('b.id'));
        
        $c = 1;
        foreach ($criteria as $field => $value) {
            $qb->andWhere('b.'.$field. '= ?'.$c)
               ->setParameter($c, $value);
            $c++;
        }
        return $qb->getQuery()->getSingleScalarResult();
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