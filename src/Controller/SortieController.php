<?php
namespace App\Controller;


use App\Entity\Campus;
use App\Entity\Etats;
use App\Entity\Inscriptions;
use App\Entity\Lieux;
use App\Entity\Participants;
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
     * @Route("/sorties/afficher/{id}", name="sortie_afficher")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function afficher(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        dump($id);
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);
        $repo = $em->getRepository(Participants::class);
        $organisateur= $repo->find($Sorties->getOrganisateur());
        dump($Sorties->getOrganisateur());



        return $this->render("sortie/afficher.html.twig",["sorties" => $Sorties,"organisateur"=>$organisateur]);
    }

    /**
     * @Route("/sorties/inscription/{id}", name="sortie_inscription")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function inscription(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        dump($id);
        dump(new \DateTime('now'));
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);
        $inscription= new Inscriptions();

        $repo = $em->getRepository(Participants::class);
        $participant= $repo->find($user->getId());
        $inscription->setDateInscription(new \DateTime('now'));
        $inscription->setSortie($Sorties);
        $inscription->setParticipant($participant);
        $em->persist($inscription);
        $em->flush();




        return $this->list($em,$user,$request);
    }

    /**
     * @Route("/sorties/desister/{id}", name="sortie_desister")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function desister(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        dump($id);
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);
        $repo = $em->getRepository(Participants::class);
        $participant= $repo->find($user->getId());
        $repo = $em->getRepository(Inscriptions::class);
        $inscription=$repo->findOneBy(array('Participant' => $participant,'sortie' => $Sorties));
        $em->remove($inscription);
        $em->flush();




        return $this->list($em,$user,$request);
    }

    /**
     * @Route("/sorties/publier/{id}", name="sortie_publier")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function publier(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        dump($id);
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);
        dump($Sorties);
        $repo = $em->getRepository(Etats::class);
        $etat=$repo->findOneBy(array('libelle' => "ouvert"));
        dump($etat);
        $Sorties->setEtat($etat);
        dump($Sorties);
        $em->persist($Sorties);
       $em->flush();




        return $this->list($em,$user,$request);
    }

    /**
     * @Route("/sorties/verifmodifier", name="sortie_verifmodifier")
     */
    public function verifmodifier(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {




            dump($request->request->all());





        return $this->render("sortie/modifier.html.twig",["sorties" => $Sorties,"participants"=>$participants,"user"=>$user,"campus"=>$campus,"organisateur"=>$organisateur,"villes"=>$ville]);
    }

    /**
     * @Route("/sorties/modifier/{id}", name="sortie_modifier")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function modifier(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);

        $repo = $em->getRepository(Participants::class);
        $participants=$repo->findAll();
        $repo = $em->getRepository(Participants::class);
        $organisateur= $repo->find($Sorties->getOrganisateur());
        $repo = $em->getRepository(Campus::class);
        $campus=$repo->findAll();
        $repo = $em->getRepository(Ville::class);
        $ville = $repo->findAll();

        if(!empty($_POST)){
            dump($request->request->all());

        }



        return $this->render("sortie/modifier.html.twig",["sorties" => $Sorties,"participants"=>$participants,"user"=>$user,"campus"=>$campus,"organisateur"=>$organisateur,"villes"=>$ville]);
    }

    /**
     * @Route("/sorties/annuler/{id}", name="sortie_annuler")
     *   * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function annuler(EntityManagerInterface $em,$id,UserInterface $user,Request $request)
    {

        dump($id);
        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->find($id);
        dump($Sorties);
        $repo = $em->getRepository(Inscriptions::class);
        $inscriptions=$repo->findBy(array('sortie' => $Sorties));
        dump($inscriptions);
        foreach ($inscriptions as $inscription) {
            $em->remove($inscription);
        }

        $em->remove($Sorties);
        $em->flush();




        return $this->list($em,$user,$request);
    }



    /**
     * @Route("/sorties", name="sortie_list")
     */
    public function list(EntityManagerInterface $em,UserInterface $user,Request $request)
    {

        $repo = $em->getRepository(Sorties::class);
        $Sorties = $repo->findAll();

        $repo = $em->getRepository(Participants::class);
        $participants=$repo->findAll();

        $repo = $em->getRepository(Campus::class);
        $campus=$repo->findAll();
        dump($request->request->all());
        if(!empty($_POST)){
            $repo = $em->getRepository(Sorties::class);
            $Sorties=$repo->findSorties($request->request->all(),$user);
            dump($Sorties);
        }



        return $this->render("sortie/list.html.twig",["sorties" => $Sorties,"participants"=>$participants,"user"=>$user,"campus"=>$campus]);
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
                $repo = $em->getRepository(Lieux::class);
                $Lelieu= $repo->find($request->request->get("lieu"));
                $repo = $em->getRepository(Etats::class);
                $Etat=$repo->findOneBy(array("libelle"=>"Ouvert"));
                $sortie->setLieu($Lelieu);
                $sortie->setEtat($Etat);
                $em->persist($sortie);
                $em->flush();

                $this->addFlash("success", "Votre sortie a bien  été crée!");

                return $this->redirectToRoute("sortie_list");
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
