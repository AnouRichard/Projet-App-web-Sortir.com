<?php

namespace App\Repository;

use App\Entity\Sorties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sorties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sorties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sorties[]    findAll()
 * @method Sorties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sorties::class);
    }

    /**
     * @return Sorties[] Returns an array of Sorties objects
     */

    public function findSorties($parametres)
    {
        foreach ($parametres as $key=> $value){
            dump($key);
            dump($value);
            switch ($value) {
                case 0:
                    echo "i égal 0";
                    break;
                case 1:
                    echo "i égal 1";
                    break;
                case 2:
                    echo "i égal 2";
                    break;
            }
        }

        $requete=$this->createQueryBuilder('s')
            ->innerJoin('s.inscriptions','i')
            ->innerJoin('i.Participant','p')
            ->innerJoin('p.campus','c')

            //->andWhere('s.etat = :val')
            //->andWhere('p = :val2')
            ->andWhere('')
            // ->setParameter('val',1)
            //->setParameter('val2',4)
            ->setParameter('val3',1)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
       dump($requete);
        return $requete;



    }


    /*
    public function findOneBySomeField($value): ?Sorties
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
