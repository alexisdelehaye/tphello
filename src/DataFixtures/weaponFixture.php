<?php
namespace App\DataFixtures;

use App\Repository\WeaponRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\ORM\Doctrine\Populator;
use App\Entity\User;
class weaponFixture extends Fixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $generator = \Faker\Factory::create('fr_FR');
        $populator = new Populator($generator, $manager);
        for ($i = 0; $i < 5; $i++) {
            $populator->addEntity('\App\Entity\Weapon', 5, array(
                'name' => function() use ($generator) { return $generator->name(); },
                'damage' => function() use ($generator) { return $generator->numberBetween(0,100);}
            ));


            /*
            $populator->addEntity('\App\Entity\User', 1, array(
                'firstName' => function() use ($generator) {return $generator->firstName();},
                'lastName' => function() use ($generator) {return $generator->lastName();},
                'email' => function() use ($generator) {return $generator->email();},
                'plainPassword' => function() use ($generator) {return $generator->realText(255);},
                'password' => function() use ($generator) {return $generator->realText(255);},
               // 'weaponUser' => function() use ($generator) {return rand(0,4);},

            ));
            */


            $populator->execute();
        }

        for ($i = 0; $i <3; $i++) {
            $user = new User();
            $user->setFirstName('Alexis');
            $user->setLastName('Delehaye');
            $user->setEmail('email'.$i);
            $user->setPlainPassword('mdp');
            $user->setPassword('mdp');
            $user->setHealth(1000);
            $user->setEnabled(true);

            $manager->persist($user);
        }
        $manager->flush();
    }
}