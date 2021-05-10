<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [];
        $categories = [];
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name)->setFirstname($faker->firstname)->setLastname($faker->lastname)
                ->setEmail($faker->email)->setPassword($faker->password)->setCreatedAt(new \DateTime);
            $manager->persist($user);
            $users[] = $user;
        }

        for($i = 0; $i <15;$i++) {
            $categorie= new Category();
            $categorie->setTitle($faker->text(50))->setDescription($faker->text(250))->setImage($faker->imageUrl());
            $manager->persist($categorie);
            $categories[] = $categorie;
        }

        for ($i = 0; $i <100;$i++) {
            $article= new Article();
            $article->setTitle($faker->text(50))->setContent($faker->text(6000))->setImage($faker->imageUrl())
                    ->setCreatedAt(new \DateTime) -> addCategory($categories[$faker->numberBetween(0,14)])
                    ->setAuthor($users[$faker->numberBetween(0,49)]);
            $manager->persist($article);
        }


        $manager->flush();
    }
}
