<?php

namespace App\Repository\User;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function get_class;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->findOneBy([User::ATTR_EMAIL => $email]);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User
    {
        return $this->findOneBy([User::ATTR_ID => $id]);
    }
}
