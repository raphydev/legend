<?php

namespace Labs\BackBundle\Repository;

/**
 * AboutRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AboutRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOnePage()
    {
        $qb = $this->createQueryBuilder('p');
        $qb->leftJoin('p.bannerImage', 'b');
        $qb->addSelect('b');
        return $qb->getQuery()->getOneOrNullResult();
    }
}