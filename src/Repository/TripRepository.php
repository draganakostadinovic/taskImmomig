<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\Trip;

class TripRepository extends EntityRepository
{
    public function newTrip($name, $lon, $lat, $ele, $date, $time, $user_id) {
        $this->getEntityManager()->persist(new Trip($name, $lon, $lat, $ele, $date, $time, $user_id));
        $this->getEntityManager()->flush();
    }

    public function findTrips($userId) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $results = $qb -> select('t.name')
            ->from ('App\Entity\Trip', 't')
            ->where('t.user_id = :user_id')
            ->setParameter('user_id', $userId)
            ->distinct(TRUE)
            ->getQuery()
            ->getResult();
        return $results;
    }

}
