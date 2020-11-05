<?php
namespace App\Controller;


use App\Entity\Sorties;
use App\Form\SortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SortieController extends AbstractController
{
    /**
     * @Route("/sorties", name="sortie_list")
     */
    public function list()
    {
        return $this->render("sortie/list.html.twig");
    }
    /**
     * @Route("/addsortie", name="sortie_add")
     */
    public function add(EntityManagerInterface $em)
    {
        $sortie= new Sorties();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        return $this->render("sortie/add.html.twig",["sortieForm" => $sortieForm->createView()]);
    }


}
