<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail('admin@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setPassword($this->passwordEncoder->encodePassword($userAdmin, 'password'));
        $manager->persist($userAdmin);

        $userUser = new User();
        $userUser->setEmail('user@gmail.com');
        $userUser->setRoles(['ROLE_USER']);
        $userUser->setPassword($this->passwordEncoder->encodePassword(
        $userUser,
        'password'
        ));
        $manager->persist($userUser);

        $manager->flush();
    }
}
