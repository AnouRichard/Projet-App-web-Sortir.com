<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SortieController extends Controller
{
    /**
     * @Route("/sorties", name="sortie_list")
     */
    public function list()
    {
        return $this->render("sortie/list.html.twig");
    }


}
