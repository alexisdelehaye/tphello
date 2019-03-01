<?php

namespace App\Controller;


use App\Entity\ActionUser;
use App\Event\ActionUserEvent;
use App\Form\Type\ActionUserDirectionType;
use App\Repository\GameRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods="GET")
     */
    public function index(Request $request, TranslatorInterface $translator, SessionInterface $session, ActionUserEvent $event, EventDispatcherInterface $dispatcher): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/game", name="home_game", methods="GET|POST")
     */
    public function game(Request $request, ActionUserEvent $event, EventDispatcherInterface $dispatcher){

        $actionUser = new ActionUser();
        $builder = $this->createFormBuilder()
        ->add('action', ActionUserDirectionType::class)
        ->add('submit', SubmitType::class, ['label' => 'Valid direction']);
        $form = $builder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $event->setDirection($data['action']);
            $dispatcher->dispatch('actionUser.create', $event);

            return $this->redirectToRoute('home_game'); //@findMe -  pourquoi redirect ? = 1pt bonus
        }
        return $this->render('home/game.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/reset", name="home_reset", methods="GET|POST")
     */
    public function reset(Request $request){

        //@todo

        return $this->redirectToRoute('home_game');
    }
}
