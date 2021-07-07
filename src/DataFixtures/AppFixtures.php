<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Gite;
use App\Entity\User;
use App\Entity\Service;
use App\Entity\Equipement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        //creation equipements
        $equipements = [];

        $eq1 = new Equipement();
        $eq1->setName('Piscine');

        $eq2 = new Equipement();
        $eq2->setName('Sauna');

        $eq3 = new Equipement();
        $eq3->setName('Lave-linge');

        $eq4 = new Equipement();
        $eq4->setName('Lave-vaisselle');

        array_push($equipements, $eq1, $eq2, $eq3, $eq4);

        $manager->persist($eq1);
        $manager->persist($eq2);
        $manager->persist($eq3);
        $manager->persist($eq4);

        $manager->flush();
         
        //creation service
        $services = [];

        $service1 = new Service;
        $service1->setName('Pension Complete')
                 ->setPrix('50');

        $service2 = new Service;
        $service2->setName('Demi pension')
                 ->setPrix('25');

        $service3 = new Service;
        $service3->setName('internet')
                 ->setPrix('3');

        array_push($services, $service1, $service2, $service3);

        $manager->persist($service1);
        $manager->persist($service2);
        $manager->persist($service3);
        
        
        $manager->flush();
        //creation gite
        for ($i=0; $i < 50; $i++) { 
            
            $gite[$i] = new Gite();
            $gite[$i]
                ->setAddress($faker->streetAddress())
                ->setPostalCode($faker->postcode())
                ->setCity($faker->city())
                ->setSuperficy($faker->numberBetween(60, 180))
                ->setBedroom($faker->numberBetween(1, 4))
                ->setNbBed($faker->numberBetween(1, 4))
                ->setAnimals((bool)rand(0, 1))
                ->setPriceAnimals($faker->randomFloat(2, 5, 10))
                ->setPriceHightSeason($faker->randomFloat(2, 80, 180))
                ->setPriceLowSeason($faker->randomFloat(2, 50, 100))
                ->setName($faker->realText(40, 1))
                ->setDescript($faker->realText(500, 1))
                ->addEquipement($faker->randomElement($equipements))
                ->addEquipement($faker->randomElement($equipements))->setFileName($faker->imageUrl(1000, 500, 'city'))
                ->setUpdatedAt($faker->dateTimeAD('now', null))
                ->addService($faker->randomElement($services))
                ->setLat($faker->randomFloat(5, -64, 106))
                ->setLng($faker->randomFloat(6, -64, 106));

            $manager->persist($gite[$i]);
        }

        //creation utilisateur
        $user1 = new User();
        $user1
              ->setUsername('admin01')
              ->setRoles(['ROLE_ADMIN'])
              ->setPassword($this->encoder->hashPassword($user1, 'admin01'));
        $manager->persist($user1);

        $user2 = new User();
        $user2
              ->setUsername('user01')
              ->setRoles(['ROLE_USER'])
              ->setPassword($this->encoder->hashPassword($user2, 'user01'));
        $manager->persist($user2);

        $user3 = new User();
        $user3
              ->setUsername('user02')
              ->setRoles(['ROLE_USER'])
              ->setPassword($this->encoder->hashPassword($user3, 'user02'));
        $manager->persist($user3);

        $manager->flush();
    }
}
