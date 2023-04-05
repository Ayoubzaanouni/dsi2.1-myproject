<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    
}
