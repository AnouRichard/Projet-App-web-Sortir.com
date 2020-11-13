<?php
namespace App\Controller;

use App\Entity\Participants;
use App\Form\CreateUserType;
use App\Form\ImportType;
use App\Service\CSVFileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\CssSelector\Parser\Reader;
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
        $userForm->remove('photo');
        $userForm->handleRequest($request);


        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $plainPassword = $user->getMotDePasse();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setMotDePasse($encoded);

            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Le compte de l'utilisateur ".$user->getMail()." a bien  été crée!");

            return $this->redirectToRoute("login");
        }
        return $this->render("main/addUser.html.twig", [
            "userForm"=> $userForm->createView()
        ]);
    }

    /**
     * @Route("/importUsers", name="importUsers")
     */
    public function ImportUser(Request $request, CSVFileUploader $file_uploader)
    {
        $userForm = $this->createForm(ImportType::class);
        $userForm->handleRequest($request);


        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $file = $userForm['fichier']->getData();
            if ($file)
            {
                $file_name = $file_uploader->upload($file);
                if (null !== $file_name)
                {
                    $directory = $file_uploader->getTargetDirectory();
                    $full_path = $directory.'/'.$file_name;
                }


            }

            $this->addFlash("success", "Le fichier a été importé");

            return $this->redirectToRoute("accueil");
        }
        return $this->render("main/importUsers.html.twig", [
            "userForm"=> $userForm->createView()
        ]);
    }
}
