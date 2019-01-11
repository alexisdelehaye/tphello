<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\WeaponUser;
use App\Service\User\HealUser;
use App\Service\WeaponUser\LoadWeapon;
use App\Service\WeaponUser\ReloadWeapon;
use App\Service\WeaponUser\ShootWeapon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user-action")
 */
class UserActionController extends AbstractController
{
    /**
     * @Route("/", name="user_action_index", methods="GET")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $weaponsUser = $em->getRepository(WeaponUser::class)->findBy(['user' => $this->getUser()]);

        $users = $em->getRepository(User::class)->findAllPlayerAlive();//$this->getUser());

        return $this->render('user_action/index.html.twig', ['weaponsUser' => $weaponsUser, 'users' => $users]);
    }


    /**
     * @Route("/reload/{id}", name="user_action_reload", methods="GET")
     */
    public function reload(WeaponUser $weaponUser, ReloadWeapon $reloadWeapon): Response
    {
        $reloadWeapon->reload($weaponUser);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @Route("/load/{id}", name="user_action_load", methods="GET")
     */
    public function load(WeaponUser $weaponUser, LoadWeapon $loadWeapon): Response
    {
        $loadWeapon->load($weaponUser);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @Route("/shoot/{id}", name="user_action_shoot", methods="GET")
     */
    public function shoot(User $user, ShootWeapon $shootWeapon): Response
    {
        $shootWeapon->shoot($user);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @Route("/ranger/{id}", name="user_action_ranger", methods="GET")
     */
    public function ranger(WeaponUser $weaponUser, LoadWeapon $loadWeapon){

     $loadWeapon->ranger($weaponUser);

        return $this->redirectToRoute('user_action_index');

    }


    /**
     * @Route("/heal/{id}", name="user_action_heal", methods="GET")
     */
    public function heal(User $user, HealUser $healUser){

        $healUser->heal($user);

        return $this->redirectToRoute('user_action_index');

    }

    /**
     * @Route("/emptyShoot/{id}", name="user_action_somation", methods="GET")
     */
    public function emptyShoot(WeaponUser $weaponUser, ShootWeapon $shootWeapon){

        $shootWeapon->emptyShoot($weaponUser);
        return $this->redirectToRoute('user_action_index');

    }
}
