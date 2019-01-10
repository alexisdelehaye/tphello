<?php

namespace App\Form;

use App\Entity\WeaponUser;
use App\Form\Type\QualityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class WeaponUserType extends AbstractType
{

    private $securityChecker;
    private $token;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quality',QualityType::class)
            ->add('ammunition')
            ->add('active')
            ->add('weapon')
            ->add('user');

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }

    public function preSetData(FormEvent $event)
    {

        $form = $event->getForm();
        $weaponUser =  $event->getData();
        //@explain set User and remove user field in form
        $user = $this->token->getToken()->getUser();
        $weaponUser->setActive(false);
        $weaponUser->setAmmunition(100);
        $weaponUser->setUser($user);

        $form->remove('ammunition');
        $form->remove('active');
        $form->remove('user');



    }


}
