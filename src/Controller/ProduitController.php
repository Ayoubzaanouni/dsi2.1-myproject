<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
   private $repoProd;
   
    public function __construct(ProduitRepository $repo)
    {
        $this->repoProd = $repo;
    }
    #[Route('/produit', name: 'app_produit')]
    public function index(/*ProduitRepository $repo*/): Response
    {
        $produits = $this->repoProd->findAll();
        return $this->render('produit/index.html.twig', ['prods'=>$produits
            
        ]);
    }
    #[Route('/produit2', name: 'app_produit2')]
    public function index2(EntityManagerInterface $em): Response
    {
        $produits = $em->getRepository(Produit::class)->findAll();
        //$produits = $this->repoProd->findAll();
        return $this->render('produit/index.html.twig', ['prods'=>$produits
            
        ]);
    }


    #[Route('/produit/{id}', name: 'app_produit')]
    public function findProd(ProduitRepository $repo,int $id): Response
    {
       $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('produit/index2.html.twig', ['produit'=>$product
            
        ]);
    }
    #[Route('/produit/add/{nom}/{prix}', name: 'app_produit')]
    public function add($nom,$prix,EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setDescription("Description  du produit".$nom);
        $produit->setQuantite(0);
        $em->persist($produit);
        $em->flush();
       // $produits = $this->repoProd->findAll();
        return $this->render('produit/add.html.twig', ['produit'=>$produit
            
        ]);
    }
}
