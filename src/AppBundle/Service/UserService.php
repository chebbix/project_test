<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    /**
     * @var EntityManagerInterface 
     */
    protected $em;
    
    /**
     * @var UserPasswordEncoderInterface 
     */
    protected $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function signin(User $user)
    {
        $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
        $this->em->persist($user);
        $this->em->flush();
        
        return $user;
    }
}
