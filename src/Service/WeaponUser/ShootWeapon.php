<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ShootWeapon
{

    private $em;
    private $session;
    private $token;

    public function __construct(EntityManagerInterface $em, SessionInterface $session, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->session = $session;
        $this->token = $token;
    }

    public function shoot(User $user)
    {


        $weaponUser = $this->em->getRepository(WeaponUser::class)->findOneBy(['user' => $this->token->getToken()->getUser(), 'active' => true]);

        if ($weaponUser instanceof WeaponUser) {
            if ($weaponUser->getAmmunition() >= 1 && $weaponUser->getActive()=== true) {
                $miss = rand(1, 10);
                if ($miss >= 8) {
                    $this->session->getFlashBag()->add('success', 'Bang Bang');

                    $user->setHealth($user->getHealth() - ($weaponUser->getQuality() * $weaponUser->getWeapon()->getDamage()));
                    $weaponUser->setAmmunition($weaponUser->getAmmunition() - 1);

                    if ($user->getHealth() <= 0) {
                        $user->setHealth(0);
                    }
                    $this->em->flush();
                }
            }else {
                $this->session->getFlashBag()->add('success', $user->getUsername() . ' n\'a pas  été touché par votre attaque !');
            }
        }
    }

    public function emptyShoot(WeaponUser $weaponUser){

        $weaponUser = $this->em->getRepository(WeaponUser::class)->findOneBy(['user' => $this->token->getToken()->getUser(), 'active' => true]);

        if ($weaponUser instanceof WeaponUser) {

            if ($weaponUser->getAmmunition() >= 1 && $weaponUser->getActive()=== true) {
                $weaponUser->setAmmunition($weaponUser->getAmmunition() - 1);
                $this->em->flush();
                $this->session->getFlashBag()->add('success', $weaponUser->getUser() . ' effectue un tir de sommation BANG BANG !!');
            }
            else {
                $this->session->getFlashBag()->add('success', $weaponUser->getUser() . ' vous n\'avez plus de munitions pour tirer !!');
            }
        }

    }


}

