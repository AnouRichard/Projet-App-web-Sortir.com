<?php
namespace App\Controller;

use App\Entity\Participants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render("profil/profil.html.twig");

    }

    /**
     * @Route("/profil/modification", name="profil_modif")
     */
    public function profil_modif()
    {


        return $this->render("profil/profil_modif.html.twig");
    }

}