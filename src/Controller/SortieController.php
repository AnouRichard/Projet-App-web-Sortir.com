<?php
namespace App\Controller;


use App\Entity\Lieux;
use App\Entity\Sorties;
use App\Entity\Ville;
use App\Form\CreateSortieType;
use App\Form\SortieType;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SortieController extends AbstractController
{
    /**
     * @Route("/sorties", name="sortie_list")
     */
    public function list(EntityManagerInterface $em,UserInterface $user)
    {
        dump($user);
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->findAll();
        return $this->render("sortie/list.html.twig",["sorties" => $Sorties]);
    }
    /**
     * @Route("/sorties/add", name="sortie_add")
     */
    public function add(EntityManagerInterface $em,Request $request,UserInterface $user)
    {
        dump($user);

        $repo = $em->getRepository(Ville::class);
        $ville = $repo->findAll();
        $sortie= new Sorties();
        $sortieForm = $this->createForm(CreateSortieType::class, $sortie);
        $sortieForm ->handleRequest($request);

        if($sortieForm->isSubmitted()){
            if($sortieForm->isValid()) {
                $sortie->setOrganisateur($user->getId());
                $sortie->setUrlPhoto("");
                $sortie->setEtatSortie(1);
                $lieu= new Lieux();
                dump($request->request->get("latitude"));
                $lieu->setLatitude($request->request->get("latitude"));
                $lieu->setLongitude($request->request->get("longitude"));
                $repo = $em->getRepository(Lieux::class);
                $Lelieu= $repo->find($request->request->get("lieu"));
                $repo = $em->getRepository(Lieux::class);
                $LaVille= $repo->find($request->request->get("ville"));
                //dump($Lelieu['nom']);
                $lieu->setNom($Lelieu->getNom());
                $lieu->setVille(LaVille);
                $lieu->setRue($request->request->get("rue"));
                dump($lieu);
                $sortie->setLieu($lieu);
                $em->persist($sortie);
                $em->persist($lieu);

                $em->flush();

                $this->addFlash("success", "Votre sortie a bien  été crée!");

                return $this->redirectToRoute("accueil");
            }
        }
        return $this->render("sortie/add.html.twig",["sortieForm" => $sortieForm->createView(),"villes" => $ville,"user"=>$user]);
    }

    /**
     * @Route("/sorties/add/getLieux", name="getLieu")
     */
    public function ajaxAction(Request $request,EntityManagerInterface $em) {
        $repo = $em->getRepository(Ville::class);
        $idVille=$request->request->get('idVille');
        $ville=$repo->find($idVille);
        $repo = $em->getRepository(Lieux::class);
        $lieux=$repo->findBy(array("ville" => $ville));
        dump($lieux);

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach($lieux as $lieu) {
                $temp = array(
                    'id' => $lieu->getId(),
                    'nom' => $lieu->getNom(),
                    'rue' => $lieu->getRue(),
                    'latitude' => $lieu->getLatitude(),
                    'longitude' => $lieu->getLongitude(),
                );
                $jsonData[$lieu->getId()] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render("sortie/add.html.twig");
        }
    }



}
