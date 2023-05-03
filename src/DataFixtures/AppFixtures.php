<?php
namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $f = new Fournisseur();
        $f->setNom('f1');
        $f->setAdresse('Sousse');
        $f->setEmail('f1@gmail.com');
        $manager->persist($f);

        
        $c = new Categorie();
        $c->setNom("c1");
        $manager->persist($c);
        for($i = 0; $i< 10 ; $i++)
        {
            $produit = new Produit();
            $produit->setNom("Produit".$i);
            $produit->setPrix(rand(100,1000));
            $produit->setDescription("Description du produit".$i);
            $produit->setQuantite(rand(0,20));
            $produit->setCategorie($c);
            $manager->persist($produit);
            $produit->addFournisseur($f);
        }
        
        $f = new Fournisseur();
        $f->setNom('f2');
        $f->setAdresse('Sousse');
        $f->setEmail('f2@gmail.com');
        $manager->persist($f);
        $c = new Categorie();
        $c->setNom("c2");
        $manager->persist($c);

        for($i = 10; $i< 20 ; $i++)
        {
            $produit = new Produit();
            $produit->setNom("Produit".$i);
            $produit->setPrix(rand(100,1000));
            $produit->setDescription("Description du produit".$i);
            $produit->setQuantite(rand(0,20));
            $produit->setCategorie($c);
            $manager->persist($produit);
            $produit->addFournisseur($f);
        }
        

        $manager->flush();
    }
}
