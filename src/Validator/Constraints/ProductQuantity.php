<?php
namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ProductQuantity extends Constraint
{
    public $message = 'Attention !la quantité que vous demandé dépasse celle déjà disponible !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}