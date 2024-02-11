<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $adminRole = new Role();
        $adminRole->setName('Admin');
        $manager->persist($adminRole);

        $userRole = new Role();
        $userRole->setName('User');
        $manager->persist($userRole);

        $manager->flush();
    }
}
