<?php

namespace App\DataFixtures;

use App\Entity\Livres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { $faker=Factory::create('fr_FR');
        for ($i=1;$i<=100;$i++)

        { $livre =new Livres();
            $livre->setLibelle($faker->name())
                ->setPrix(random_int(10,300))
                ->setDescription($faker->text())
                ->setDateEdition(new \DateTime('01-01-2022'))
                ->setImage('https://picsum.photos/300/?random='.$i)
                ->setEditeur($faker->company());
            $em=$manager->persist($livre);
                 }
        $manager->flush();



    }
}
