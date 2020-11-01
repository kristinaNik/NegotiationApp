<?php

namespace App\Command;

use App\Handlers\FileHandler;
use App\Services\EvaluationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProposalCommand extends Command
{
    protected static $defaultName = 'proposal:negotiate';

    /**
     * @var FileHandler
     */
    private $fileHandler;


    private $evaluationService;

    public function __construct(FileHandler $fileHandler, EvaluationService $evaluationService)
    {
        parent::__construct();
        $this->fileHandler = $fileHandler;
        $this->evaluationService = $evaluationService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Choose pc and give a score for each proposal')

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

        $proposalScores = [];
        for ($i=1; $i<=3; $i++) {
            $pc = $io->choice('Choose pc to evaluate', ['Dell', 'Lenovo', 'Asus']);
            $proposalScores[$pc] = $io->ask("Set scores for processor, screen, ram, certified");
        }

        $this->evaluationService->setScoreCriteria($proposalScores);
        $getTotal = $this->evaluationService->calculateScoreTotal();
        $evaluate = $this->evaluationService->evaluateMaxScore($getTotal);

        $io->success($this->displayResult($evaluate));

        return Command::SUCCESS;
    }

    private function displayResult($evaluate)
    {
        $output = '';

        foreach ($evaluate as $pc => $score) {
            $output =  sprintf('The preferred proposal is %s  with a score %s', $pc, $score);
        }

        return $output;
    }
}
