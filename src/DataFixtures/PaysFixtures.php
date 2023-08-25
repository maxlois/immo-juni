<?php

namespace App\DataFixtures;

use App\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaysFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
           $pays = new Pays();
           $pays->setNomP('France');
           $pays->setlangue('Français');
           $pays->setidentifTel('33');
           $pays->setcodeIso('FR');

            $manager->persist($pays);

        $manager->flush();
    }
}
