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
                case "nomSort":
                    $conditions=$conditions."s.nom like '%".$value."%'";
                    break;
                case "campus":
                    $conditions=$conditions."EXISTS(SELECT t0.id AS id_1, t0.pseudo AS pseudo_2, t0.nom AS nom_3, t0.prenom AS prenom_4, t0.telephone AS telephone_5, t0.mail AS mail_6, t0.mot_de_passe AS mot_de_passe_7, t0.administrateur AS administrateur_8, t0.actif AS actif_9, t0.campus_id AS campus_id_10 FROM participants as t0 where t0.campus_id=1)";
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
            ->leftJoin('p.campus','c')
           ->innerJoin('s.etat','e')
            ->andWhere($conditions)
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
