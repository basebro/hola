<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Admin');
        $user->setUsername('admin');
        $user->setPassword('adminpassword');
        $user->setRoles('ADMIN');
        $manager->persist($user);

        $manager->flush();
    }
}
