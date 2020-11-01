<?php

namespace App\Command;

use App\Services\EvaluationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProposalCommand extends Command
{
    protected static $defaultName = 'proposal:negotiate';



    private $evaluationService;

    public function __construct( EvaluationService $evaluationService)
    {
        parent::__construct();
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
        $io->listing(['Dell - i7, Quadcore 2,3 GHz, full HD, 16 Gb RAM, energy star 100 certified - 2500 €',
            'Lenovo - i5, Quadcore 2,2 GHz, full HD, 8 GB RAM, energy star 100 certified- 2300 €',
            'Asus - i7, Quadcore 2,1 GHz, Ultra HD, 8 GB RAM, energy star 80 certified- 2000 €']);

        $proposalScores = [];
        $prices = [
            'Dell' => 2500,
            'Lenovo' => 2300,
            'Asus' => 2000
        ];

        for ($i=1; $i<=3; $i++) {
            $pc = $io->choice('Choose pc to evaluate', ['Dell', 'Lenovo', 'Asus']);
            $proposalScores[$pc] = $io->ask("Set scores for processor, screen, ram, certified");
        }

        $this->evaluationService->setScoreCriteria($proposalScores);
        $getPrice = $this->evaluationService->calculatePrice($prices);
        $getTotal = $this->evaluationService->calculateScoreTotal($getPrice);
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
