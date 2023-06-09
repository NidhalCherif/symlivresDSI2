<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Livres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { $faker=Factory::create('fr_FR');
        for($j=1;$j<=3;$j++) {
            $cat = new Categories();
            $cat->setLibelle($faker->name())
                ->setDescription($faker->text);
            $manager->persist($cat);

            for ($i = 1; $i <= random_int(10, 15); $i++) {
                $livre = new Livres();
                $livre->setLibelle($faker->name())
                    ->setPrix(random_int(10, 300))
                    ->setDescription($faker->text())
                    ->setDateEdition(new \DateTime('01-01-2022'))
                    ->setImage('https://picsum.photos/300/?random=' . $i)
                    ->setEditeur($faker->company())
                    ->setCategorie($cat);
                $em = $manager->persist($livre);
            }
        }
        $manager->flush();
    }
}
