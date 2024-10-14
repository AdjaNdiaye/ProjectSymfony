<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $encoder;
public function __construct(UserPasswordHasherInterface $encoder)
{
    $this->encoder = $encoder; 
 }
    public function load(ObjectManager $manager): void
    {
         $user = new User();
         $user->setNom('ndiaye')->setPrenom('adja');
         $user->setEmail('adja/ndiaye@gmail.com');
         $encoded = $this->encoder->hashpassword($user,'123');
         $user->setPassword($encoded);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);
        $manager->flush();
    }
}
