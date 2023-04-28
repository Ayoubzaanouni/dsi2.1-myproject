<?php
namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
        }
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
        }
        

        $manager->flush();
    }
}
