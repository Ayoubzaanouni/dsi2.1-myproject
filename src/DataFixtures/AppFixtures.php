<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i< 20 ; $i++)
        {
            $produit = new Produit();
            $produit->setNom("Produit".$i);
            $produit->setPrix(rand(100,1000));
            $produit->setDescription("Description du produit".$i);
            $produit->setQuantite(rand(0,20));
            $manager->persist($produit);
        }
        

        $manager->flush();
    }
}
