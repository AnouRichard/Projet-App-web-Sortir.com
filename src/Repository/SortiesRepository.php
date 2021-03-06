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
        $verifparenthese="";
        $conditions="";
        foreach ($parametres as $key=> $value){
            dump($key);
            switch ($key) {
                case "nomSortie":
                    $conditions=$conditions." s.nom like '%".$value."%'";
                    break;

                case "entreDate":
                    if($value!=""){
                        if($verifparenthese=="") {
                            $verifparenthese = "(";
                            $conditions = $conditions . " and ".$verifparenthese." s.dateDeDebut >= '" . $value . "'";
                        }else{
                            $conditions = $conditions . " and  s.dateDeDebut >= '" . $value . "'";
                        }
                    }
                    break;

                case "sortieDate":
                    if($value!=""){
                        if($verifparenthese=="") {
                            $verifparenthese = "(";
                            $conditions=$conditions." and ".$verifparenthese." s.dateCloture <= '".$value."'";
                        }else{
                            $conditions=$conditions." and s.dateCloture <= '".$value."'";
                        }
                    }
                    break;
                case "camp":
                    $conditions=$conditions."EXISTS(SELECT  t0 . id  AS  id_1 ,  t0 . pseudo  AS  pseudo_2 ,  t0 . nom  AS  nom_3 ,  t0 . prenom  AS  prenom_4 ,  t0 . téléphone  AS  telephone_5 ,  t0 . mail  AS  mail_6 ,  t0 . mot_de_passe  AS  mot_de_passe_7 ,  t0 . administrateur  AS  administrateur_8 ,  t0 .actif  AS  actif_9 ,  t0 . campus_id  AS  campus_id_10  FROM  participants  t0)";
                    break;

                case "sortieOrga":
                    if($verifparenthese=="") {
                        $verifparenthese = "(";
                        $conditions=$conditions.$verifor.$verifparenthese." s.organisateur = ".$user->getId();
                        $verifor=" or";
                    }else{
                        $conditions=$conditions.$verifor." s.organisateur = ".$user->getId();
                    }
                    break;
                case "sortieinscrit":
                    if($verifparenthese=="") {
                        $verifparenthese = "(";
                        $conditions=$conditions.$verifor.$verifparenthese." p = ".$user->getId();
                        $verifor=" or";
                    }else{
                        $conditions=$conditions.$verifor." p = ".$user->getId();
                    }
                    break;
                case "sortiePasInscrit":
                    if($verifparenthese=="") {
                        $verifparenthese = "(";
                        $conditions=$conditions.$verifor.$verifparenthese." p != ".$user->getId();
                        $verifor=" or";
                    }else{
                        $conditions=$conditions.$verifor." p != ".$user->getId();
                    }
                    break;
                case "sortiepasse":
                    if($verifparenthese=="") {
                        $verifparenthese = "(";
                        $conditions=$conditions.$verifor.$verifparenthese." e = 'Ferme' ";
                        $verifor=" or";
                    }else{
                        $conditions=$conditions.$verifor." e = 'Ferme' ";
                    }
                    break;
            }
        }
        if  ($verifparenthese == "("){
            $conditions=$conditions.")";
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
