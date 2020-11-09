<?php
namespace App\Controller;

use App\Entity\Participants;
use App\Form\CreateUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render("main/login.html.twig", [

            'error'=> $error,
        ]);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/adduser", name="add_user")
     */
    public function addUser(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new Participants();
        $userForm = $this->createForm(CreateUserType::class, $user);
        $userForm->handleRequest($request);

        if($userForm->isSubmitted()){
            if($userForm->isValid()) {


                $plainPassword = $user->getMotDePasse();
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setMotDePasse($encoded);

                $em->persist($user);
                $em->flush();

                $this->addFlash("success", "Votre compte a bien  été crée!");

                return $this->redirectToRoute("accueil");
             }
        }
        return $this->render("main/userForm.html.twig", [
            "userForm"=> $userForm->createView()
        ]);
    }

}
