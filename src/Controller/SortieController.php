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
        $maValeur = $request->request->get("ville", " ");
        dump($maValeur);
        return $this->render("sortie/add.html.twig",["sortieForm" => $sortieForm->createView(),"villes" => $ville]);
    }

    /**
     * @Route("/sorties/add/ajax", name="sortie_add_ajax")
     */
    public function ajaxAction(Request $request,EntityManagerInterface $em) {
        $repo = $em->getRepository(Lieux::class);
        $lieu=$repo->findAll();
        dump($lieu);
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = $lieu;
           /* $idx = 0;
            foreach($students as $student) {
                $temp = array(
                    'name' => $student->getName(),
                    'address' => $student->getAddress(),
                );
                $jsonData[$idx++] = $temp;
            }*/
            return new JsonResponse("test");
        } else {
            return $this->render("sortie/add.html.twig");
        }
    }

}
