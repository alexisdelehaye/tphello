<?php

namespace App\EventListener;


use App\Entity\ActionUser;
use App\Event\ActionUserEvent;
use App\Event\UserEvent;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ActionUserListener {

    private $entityManager;
    private $token;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->token = $tokenStorage;
    }

    public function sauvegardeActionUser(ActionUserEvent $event)
    {
        $user = $this->token->getToken()->getUser();
        $direction = $event->getDirection();
        $actionUser = new ActionUser();
        $actionUser->setDirection($direction);
        $actionUser->setPositionY($user->getPositionY());
        $actionUser->setPositionX($user->getPositionX());
        $actionUser->setUser($user);
        $actionUser->setCreatedAt(new \DateTime());

        $event->setActionUser($actionUser);
    }

    public function deplacement(ActionUserEvent $event)
    {
        $user = $this->token->getToken()->getUser();
        switch ($event->getDirection()) {
            case 'LEFT':
                if($user->getPositionX() > 0)
                $user->setPositionX($user->getPositionX() - 1);
                break;
            case 'RIGHT' :
                if ($user->getPositionX() < 10)
                $user->setPositionX($user->getPositionY() + 1);
                break;
            case 'TOP':
                if($user->getPositionY() > 0)
                $user->setPositionY($user->getPositionY() - 1);
                break;
            case 'BOTTOM' :
                if ($user->getPositionY() <10)
                $user->setPositionY($user->getPositionY() + 1);
                break;
            default :
                break;
        }
            $this->entityManager->persist($user);
            $this->entityManager->flush();
    }

    public function onActionUserCreate(ActionUserEvent $event)
    {
        $this->entityManager->persist($event->getActionUser());
        $this->entityManager->flush();
    }
}