<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $faker =  Faker\Factory::create();

        $types = ["Entrée","Plat", "Dessert"];
        $entrees= ["Avocat Crevette", "Salade de riz", "Salade aux poivrons",
         "carottes cumin vinaigre", "salade pomme de terre"];
        $plats = ["Tajine", "Tanjia", "Couscous", "Pastilla", "Plat au poulets"];
        $desserts = ["Banane  au chocolat", "fraise", "salade de fruits"];
        
        foreach($types as $type){
            $category = new Category();
            $category->setName($type);

            if($type == "Plat"){$tab = $plats;}
            else{$tab = $desserts;}

            foreach($tab as $item){
                $product = new Product();
                $product->setLabel($item);
                $product->setDescription($faker->text);
                $product->setPrice($faker->randomFloat(2,10,80));
                $product->setAvis($faker->numberBetween(1,5));
                $product->setCategory($category);

                $category->addProduct($product);
                $manager->persist($product);

            }
            $manager->persist($category);
        }

        $manager->flush();
    }

}
