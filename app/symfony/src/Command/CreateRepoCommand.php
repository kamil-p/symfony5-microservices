<?php
namespace App\Command;

use App\Entity\Repo;
use App\Entity\User;
use App\Repository\UserRepository;
use Nubs\RandomNameGenerator\All;
use Nubs\RandomNameGenerator\Alliteration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-repo';

    private UserRepository $userRepo;

    private All $nameGenerator;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->nameGenerator = new All([new Alliteration()]);
    }


    protected function configure()
    {
        $this
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $this->userRepo->findLast();

        $repo = new Repo($user, $this->getName());

        $this->userRepo->save($repo);

        $output->writeln($user->toString());

        return 0;
    }
}