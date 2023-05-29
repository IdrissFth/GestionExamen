<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\EnseignantFactory;
use App\Factory\EtudiantFactory;
use App\Factory\FilliereFactory;
use App\Factory\ModuleFactory;
use App\Factory\NoteFactory;
use App\Factory\SemestreFactory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EnseignantFactory::new()->createMany(10);
        EtudiantFactory::new()->createMany(10);
        FilliereFactory::new()->createMany(10);
        ModuleFactory::new()->createMany(10);
        NoteFactory::new()->createMany(10);
        SemestreFactory::new()->createMany(10);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
