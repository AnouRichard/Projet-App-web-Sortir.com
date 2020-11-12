<?php
namespace App\Controller;

use App\Entity\Participants;
use App\Form\CreateUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\FileUploader;

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
     * @Route("/profil/update/{id}", name="profilUpdate")
     * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function profil_update(EntityManagerInterface $em,$id, Request $request, UserPasswordEncoderInterface $encoder, FileUploader $fileUploader)
    {
        $participantsRepo = $this->getDoctrine()->getRepository(Participants::class);
        $participant = $participantsRepo->find($id);

        $user = $this->getUser();
        $userForm = $this->createForm(CreateUserType::class, $user);
        $userForm->remove('actif')
            ->remove('administrateur');

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user = $userForm->getData();
            $plainPassword = $user->getMotDePasse();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setMotDePasse($encoded);

            $photo = $userForm->get('photo')->getData();
            if ($photo) {
                $filename = $fileUploader->upload($photo);
                $user->setPhoto($filename);

                $em->persist($user);
                $em->flush();

                $this->addFlash("success", "Votre profil a été mis à jour");

                return $this->redirectToRoute("accueil");
            }
        }
            return $this->render("profil/profil_update.html.twig", [
                "partcicipant" => $participant,
                "userForm" => $userForm->createView()
            ]);
        }
}