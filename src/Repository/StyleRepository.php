<?php

namespace App\Repository;

use App\Entity\Style;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Style>
 *
 * @method Style|null find($id, $lockMode = null, $lockVersion = null)
 * @method Style|null findOneBy(array $criteria, array $orderBy = null)
 * @method Style[]    findAll()
 * @method Style[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StyleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Style::class);
    }

    public function add(Style $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Style $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function listeStylesComplete(): array
   {
       return $this->createQueryBuilder('sty')
       ->select("sty","alb")
        ->leftJoin("sty.albums","alb")
           ->orderBy('sty.nom', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }
   
    /**
    * @return Query Returns an array of Album objects
    */
    public function listeStylesCompletePaginee(): ?Query
    {
        return $this->createQueryBuilder('sty')
            ->select("sty","alb")
            ->leftJoin("sty.albums","alb")
           ->orderBy('sty.nom', 'ASC')
           ->getQuery()
        ;
    }
//    /**
//     * @return Style[] Returns an array of Style objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Style
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
