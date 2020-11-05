<?php
namespace App\Controller;


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
     * @Route("/add", name="sortie_add")
     */
    public function add()
    {
        return $this->render("sortie/add.html.twig");
    }


}
