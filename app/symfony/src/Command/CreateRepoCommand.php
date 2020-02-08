<?php
namespace App\Command;

use App\Entity\Repo;
use App\Repository\DeveloperRepository;
use Nubs\RandomNameGenerator\All;
use Nubs\RandomNameGenerator\Alliteration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateRepoCommand extends Command
{
    protected static $defaultName = 'app:create-repo';

    private DeveloperRepository $developerRepository;

    private All $nameGenerator;

    public function __construct(DeveloperRepository $userRepo)
    {
        parent::__construct();
        $this->developerRepository = $userRepo;
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
        $developer = $this->developerRepository->findLast();

        $repo = new Repo($developer, $this->getName());

        $this->developerRepository->save($repo);

        $output->writeln($developer->toString());

        return 0;
    }
}