<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'LEFT' => 'LEFT',
                'TOP' => 'TOP',
                'RIGHT' => 'RIGHT',
                'BOTTOM' => 'BOTTOM'
            ],
            'multiple' => false,
            'expanded' => true,
        ]);

    }

    public function getParent(){
        return ChoiceType::class;
    }
}