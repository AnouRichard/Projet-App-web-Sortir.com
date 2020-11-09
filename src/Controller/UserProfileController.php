<?php
namespace App\Controller;

use App\Entity\Participants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil")
     * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function profil($id)
    {
        $participantsRepo = $this->getDoctrine()->getRepository(Participants::class);
        $participant = $participantsRepo->find($id);
        return $this->render("profil/profil.html.twig", [

                "partcicipant"=>$participant
        ]);

    }

    /**
     * @Route("/profil/update", name="profil_update")
     */
    public function profil_update()
    {
        return $this->render("profil/profil_update.html.twig");
    }

}