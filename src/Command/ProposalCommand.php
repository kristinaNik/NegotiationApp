<?php

namespace App\Command;

use App\Handlers\DataHandler;
use App\Handlers\FileHandler;
use App\Services\ProposalService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProposalCommand extends Command
{
    protected static $defaultName = 'proposal:negotiate';

    /**
     * @var FileHandler
     */
    private $fileHandler;


    private $proposalService;

    public function __construct(FileHandler $fileHandler, ProposalService $proposalService)
    {
        parent::__construct();
        $this->fileHandler = $fileHandler;
        $this->proposalService = $proposalService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Choose pc and give a score for each proposal')
            ->addArgument('pc', InputArgument::REQUIRED, 'Dell')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')

        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $choosePc = $input->getArgument('pc');

        $this->proposalService->setData($this->fileHandler->getCsvData());

        $check = $this->proposalService->checkProposalArgument($choosePc);


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
