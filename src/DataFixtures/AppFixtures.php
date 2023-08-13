<?php

namespace App\DataFixtures;

use app\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          $pays = new Pays();
          $pays-> setnom ('Ghana')
          -> setlangue ('anglais')
          -> setidentifTel ('+223')
          -> setcodeIso ('GH');
        
          $manager->persist($utilsateur);

        $manager->flush();
    }
}
