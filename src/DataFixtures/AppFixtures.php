<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Ouvrage;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = FakerFactory::create();
        
        $cat[0] = new Categorie();
        $cat[0]->setLibelle('livre');
        $manager->persist($cat[0]);
        $cat[1] = new Categorie();
        $cat[1]->setLibelle('article');
        $manager->persist($cat[1]);

        $ouvrages = [];
        for($i=0; $i<21; $i++){
            $ouvrages[$i] = new Ouvrage();
            $ouvrages[$i]->setTitre($faker->sentence($faker->numberBetween(1,4)));
            $ouvrages[$i]->setCategorie($cat[$faker->numberBetween(0,1)]);
            $manager->persist($ouvrages[$i]);

        }
        
        $auteurs = [];
        for($i=0; $i<12; $i++){
            $auteurs[$i] = new Auteur();
            $auteurs[$i]->setNom($faker->lastName());
            $auteurs[$i]->setPreNom($faker->firstName());
            $auteurs[$i]->addOuvrage($ouvrages[$faker->numberBetween(0,20)]);
            $manager->persist($auteurs[$i]);

        }

        $manager->flush();
    }
}
