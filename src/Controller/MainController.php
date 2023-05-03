<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Form\Fournisseur2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        $nom = "Zaanouni";
        $prenom= "ayoub";
        /* $rep = new Response('<html><head></head><body>Bonjour</body></html>');
        return $rep;*/
        $rep =$this->render('main/index.html.twig', ['n'=> $nom,'p'=> $prenom
        
        ]);
        return $rep;
        /*return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);*/
    }
    #[Route('/liste', name: 'app_liste')]
    public function liste(): Response
    {
        $nom = "Laribi";
        $prenom= "Maha";
        /* $rep = new Response('<html><head></head><body>Bonjour</body></html>');
        return $rep;*/
        $rep =$this->render('main/liste.html.twig', ['n'=> $nom,'p'=> $prenom
        
        ]);
        return $rep;
        /*return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);*/
    }
    #[Route('/', name: 'app_accueil')]
    public function accueil(): Response
    {
       
       return $this->render('main/accueil.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/somme/{a}/{b}', name: 'app_somme')]
    public function somme($a,$b): Response
    {
       $somme = $a + $b;
       return $this->render('main/somme.html.twig', [
            'nb1'=> $a, 'nb2' => $b, 'som'=> $somme
        ]);
    }
    #[Route('/four/add', name: 'app_four_add')]
    public function add(EntityManagerInterface $em,Request $request): Response
    {
        // creation de l'entite
        $f = new Fournisseur();
        //creation du formulaire 
        $form = $this->createForm(Fournisseur2Type::class, $f);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $f = $form->getData();
            $em->persist($f);
            $em->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_fournisseur_index');
        }


        return $this->render('main/fouradd.html.twig', ['formf'=>$form
            
        ]);
    }
}
