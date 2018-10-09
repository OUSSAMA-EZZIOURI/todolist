<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("oussama@gmail.com");
        $user->setPassword("oussama");
        $user->setFirstName("Oussama");
        $user->setLastName("EZZIOURI");
        $user->setAgency("Nouaceur");
        $manager->persist($user);

        $manager->flush();
    }
}
