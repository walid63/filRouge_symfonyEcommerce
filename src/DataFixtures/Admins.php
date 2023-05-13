<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordHasherInterface;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as HasherUserPasswordHasherInterface;

class Admins extends Fixture
{
    private $passEncode;
    private $admin;

    public function __construct(HasherUserPasswordHasherInterface $passEncode)
    {
        $this->passEncode = $passEncode; 
        $this->admin = new User();       
    }

    public function load(ObjectManager $manager): void
    {

        $this->admin->setFirstname("Jean");
        $this->admin->setLastname("Bouzid");
        $this->admin->setUsername("jibey_du63");
        $this->admin->setEmail("jibey_du63@gmail");
        $this->admin->setAddress("5 place de la brebis mal garrer");
        $this->admin->setVille("clermont-fd");
        $this->admin->setCodePostal("63250");
        $this->admin->setIsAdmin(true);
        $this->admin->setIsBanned(false);
        $this->admin->setTel("+33644852147");
        $this->admin->setRoles(["ROLE_ADMIN"]);

        $password = "0000";

        $this->admin->setPassword($this->passEncode->hashPassword($this->admin,$password));
        $manager->persist($this->admin);
        $manager->flush();
    }

    
}
