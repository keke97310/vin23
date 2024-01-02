<?php

namespace App\DataFixtures;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $red = new Category();
        $red->setName('Rouge');
        $manager->persist($red);

        $white = new Category();
        $white->setName('Blanc');
        $manager->persist($white);
        
        $pink = new Category();
        $pink->setName('Rosé');
        $manager->persist($pink);
        
        $manager->flush(); 
    }
}
