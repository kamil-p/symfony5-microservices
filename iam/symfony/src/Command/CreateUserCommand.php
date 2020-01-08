<?php
namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Nubs\RandomNameGenerator\All;
use Nubs\RandomNameGenerator\Alliteration;
use Nubs\RandomNameGenerator\Vgng;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    private UserRepository $userRepo;
    
    private All $nameGenerator;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->nameGenerator = new All(
            [
                new Alliteration(),
                new Vgng()
            ]
        );
    }


    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setFirstName($this->nameGenerator->getName());
        $user->setLastName($this->nameGenerator->getName());
        $user->setEmail(
            strtolower($user->getFirstName()) . '.' . strtolower($user->getLastName())
        );

        $this->userRepo->save($user);

        $output->writeln($user->toString());

        return 0;
    }
}