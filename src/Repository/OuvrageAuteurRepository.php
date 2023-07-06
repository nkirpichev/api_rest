<?php

namespace App\Repository;

use App\Entity\OuvrageAuteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OuvrageAuteur>
 *
 * @method OuvrageAuteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method OuvrageAuteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method OuvrageAuteur[]    findAll()
 * @method OuvrageAuteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuvrageAuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OuvrageAuteur::class);
    }

    public function save(OuvrageAuteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OuvrageAuteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OuvrageAuteur[] Returns an array of OuvrageAuteur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OuvrageAuteur
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
