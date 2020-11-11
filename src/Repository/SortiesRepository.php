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

    public function findSorties($parametres,$user)
    {
        $verifor=" and";
        $conditions="";
        foreach ($parametres as $key=> $value){
            dump($key);
            switch ($key) {
                case "campus":
                    $conditions=$conditions."c = ".$value;
                    break;
                case "sortieOrga":
                    $conditions=$conditions.$verifor." s.organisateur = ".$user->getId();
                    $verifor=" or";
                    break;
                case "sortieinscrit":
                    $conditions=$conditions.$verifor." p = ".$user->getId();
                    $verifor=" or";
                    break;
                case "sortiePasInscrit":
                    $conditions=$conditions.$verifor." p != ".$user->getId();
                    $verifor=" or";
                    break;
                case "sortiepasse":
                    $conditions=$conditions.$verifor." e = 'Ferme' ";
                    $verifor=" or";
                    break;
            }
        }
            dump($conditions);
        $requete=$this->createQueryBuilder('s')
           ->leftJoin('s.inscriptions','i')
           ->leftJoin('i.Participant','p')
            ->innerJoin('p.campus','c')
           ->innerJoin('s.etat','e')
            //->andWhere($conditions)
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
