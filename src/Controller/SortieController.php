<?php
namespace App\Controller;


use App\Entity\Sorties;
use App\Entity\Ville;
use App\Form\CreateSortieType;
use App\Form\SortieType;
use App\Repository\VilleRepository;
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
     * @Route("/sorties/add", name="sortie_add")
     */
    public function add(EntityManagerInterface $em,Request $request)
    {
        $repo = $em->getRepository(Ville::class);
        $ville = $repo->findAll();
        $sortie= new Sorties();
        $sortieForm = $this->createForm(CreateSortieType::class, $sortie);
        $sortieForm ->handleRequest($request);
        dump($sortieForm->getData());
        return $this->render("sortie/add.html.twig",["sortieForm" => $sortieForm->createView(),"villes" => $ville]);
    }


}
