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
    private $repoProduit;
    public function __construct(ProduitRepository $r)
    {
        $this->repoProduit = $r;
    }


    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $repo): Response
    {
        //Methode 1
        $produits = $repo->findAll();
        return $this->render('produit/index.html.twig', ['prods'=>$produits

        ]);
    }
    #[Route('/produit2', name: 'app_produit_2')]
    public function liste(EntityManagerInterface $em): Response
    {
        //Methode 2
        $repo = $em->getRepository(Produit::class);
        $produits = $repo->findAll();

        //$produits = $repo->findAll();
        return $this->render('produit/index.html.twig', ['prods'=>$produits

        ]);
    }
    #[Route('/produit/{id}', name: 'app_produit_one')]
    public function findProd(int $id): Response
    {
        $product = $this->repoProduit->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('produit/index2.html.twig', ['produit'=>$product

        ]);
    }
    #[Route('/produit/add/{nom}/{prix}', name: 'app_produit_add')]
    public function add($nom, $prix, EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setDescription("Description du produit".$nom);
        $produit->setQuantite(0);

        $em->persist($produit);
        $em->flush();

        return $this->render('produit/add.html.twig', ['produit'=>$produit

        ]);
    }
    #[Route('/produit/delete/{id}', name: 'app_produit_delete')]
    public function delete($id, EntityManagerInterface $em): Response
    {
        $produit = $em->getRepository(Produit::class)->find($id);

        if ($produit) {
            $em->remove($produit);
            $em->flush();

            return $this->render('produit/delete.html.twig', ['id'=>$id

            ]);
        } else {
            throw $this->createNotFoundException(
                'Produit inexistant '.$id
            );
        }
    }
    #[Route('/produit/update/{id}/{prix}', name: 'app_produit_update')]
    public function update($id,$prix, EntityManagerInterface $em): Response
    {
        $produit = $em->getRepository(Produit::class)->find($id);

        if ($produit) {

            $produit->setPrix($prix);
            $em->persist($produit);
            $em->flush();

            return $this->render('produit/update.html.twig', ['produit'=>$produit

            ]);
        } else {
            throw $this->createNotFoundException(
                'Produit inexistant '.$id
            );
        }
    }
}
