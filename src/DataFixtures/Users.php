<?php

namespace App\DataFixtures;


use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Users extends Fixture
{
    private $passEncode;
    private $user;


    public function __construct(UserPasswordHasherInterface $passEncode)
    {
        $this->passEncode = $passEncode;
        $this->user = new User;
    }


    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->user);
            $this->user->setFirstname($faker->firstname());
            $this->user->setLastname($faker->lastname());
            $this->user->setUsername($faker->username());
            $this->user->setEmail($faker->email());
            $this->user->setAddress($faker->address());
            $this->user->setVille($faker->city());
            $this->user->setCodePostal(rand(63000, 63900));
            $this->user->setIsAdmin(false);
            $this->user->setIsBanned(false);
            $this->user->setTel("+33644852147");
            $this->user->setRoles(["ROLE_USER"]);
            $this->user->setIpAddress("1.92.11." . rand(1, 9));

            $password = "0000";

            $this->user->setPassword($this->passEncode->hashPassword($this->user, $password));

            $manager->flush();
        }

        
    }
}
