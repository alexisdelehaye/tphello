<?php
/**
 * Created by PhpStorm.
 * User: alexis.delehaye
 * Date: 28/02/19
 * Time: 12:10
 */

namespace App\Event;

use App\Entity\ActionUser;
use Symfony\Component\EventDispatcher\Event;

class ActionUserEvent extends Event{

    private $direction;
    private $actionUser;

    public function getDirection()
    {
        return $this->direction;
    }


    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    public function getActionUser() : ActionUser
    {
        return $this->actionUser;
    }

    public function setActionUser(ActionUser $actionUser) {
        $this->actionUser = $actionUser;
    }

}