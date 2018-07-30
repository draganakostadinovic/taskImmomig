<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use \App\Entity\Users;

class UsersRepository extends EntityRepository
{
    public function signUp($name, $surname, $username, $password) {
        $this->getEntityManager()->persist(new Users($name, $surname, $username, $password));
        $this->getEntityManager()->flush();
    }
}
