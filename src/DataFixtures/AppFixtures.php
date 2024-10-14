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
        
        $admin = new User();
        $admin->setNom('Admin')->setPrenom('Yvon');
        $admin->setEmail('admin@ecommerce.com');
        $encodedAdmin = $this->encoder->hashPassword($admin, 'admin_password');
        $admin->setPassword($encodedAdmin);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $employee = new User();
        $employee->setNom('Dupont')->setPrenom('Jules');
        $employee->setEmail('jules.dupont@ecommerce.com');
        $encodedEmployee = $this->encoder->hashPassword($employee, 'employee_password');
        $employee->setPassword($encodedEmployee);
        $employee->setRoles(['ROLE_EMPLOYEE']);
        
        $manager->persist($admin);
        $manager->persist($employee);
        $manager->persist($user);
        $manager->flush();
    }
}
