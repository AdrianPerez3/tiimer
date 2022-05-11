<?php

namespace App\Repository;

use App\Entity\Tiimer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tiimer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tiimer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tiimer[]    findAll()
 * @method Tiimer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiimerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tiimer::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Tiimer $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Tiimer $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function getTotalTimeOrdered(){
//        $dql = 'SELECT (SUM(time_diff(end_time , start_time))) as TOTAL , `date`  FROM App\Entity\Tiimer t GROUP BY t.date';
//        $query = $this->getEntityManager()->createQuery($dql);
//        return $query->execute();

        $sql = 'SELECT TIME_TO_SEC(SUM(TIMEDIFF(end_time , start_time))) as TOTAL , `date`  FROM ejemplo.tiimer t GROUP BY `date`;';

        $entityManager = $this->getEntityManager();
        $conn = $entityManager->getConnection();
        return $conn->executeQuery($sql)->fetchAll();


    }


    public function getCountbyDate(){
        $sql = 'SELECT DISTINCT(date), COUNT(date) as count  FROM ejemplo.tiimer t GROUP BY date';

        $entityManager = $this->getEntityManager();
        $conn = $entityManager->getConnection();
        return $conn->executeQuery($sql)->fetchAll();
    }


    // /**
    //  * @return Tiimer[] Returns an array of Tiimer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tiimer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
