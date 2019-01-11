<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
// the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')

            // configure an argument
            ->addArgument('firstName', InputArgument::REQUIRED, 'The firstName of the user.')
            ->addArgument('lastName', InputArgument::REQUIRED, 'the lastName of the user')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user.')
            ->addArgument('plainPassword', InputArgument::REQUIRED, 'The password of the user')
            // ...
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // echo($input->getArgument('username'));
        $output->writeln('firstName: ' . $input->getArgument('firstName'));
    }
}