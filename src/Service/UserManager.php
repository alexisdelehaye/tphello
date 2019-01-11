<?php
/**
 * Created by PhpStorm.
 * User: alexis.delehaye
 * Date: 10/01/19
 * Time: 12:52
 */

namespace App\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Twig\Token;

class UserManager
{

    public function __construct(EntityManager $entityManager,UserPasswordEncoderInterface $passwordEncoder, TokenStorageInterface $tokenStorage)
    {

        
    }

}