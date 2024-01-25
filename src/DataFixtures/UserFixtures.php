<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $role = new Role();
        $role->setName('Admin');
        $manager->persist($role);

        $role2 = new Role();
        $role2->setName('User');
        $manager->persist($role2);

        $username=['Xavier','Test','Toto' ];

        foreach($username as $key => $value)
        {
            $user = new User();
            $user->setUsername($value);
            $user->setPassword(password_hash('test',PASSWORD_BCRYPT));

            if($key ==5)
            {
                $user->setRole($role);

            }else
            {
                $user->setRole($role2);
            }
            $manager->persist($user);
        }

        $manager->flush();
    }
}
