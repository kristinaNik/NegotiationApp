<?php

namespace App\Command;

use App\Services\ProposalCalculation;
use App\Services\ProposalService;
use App\Services\EvaluationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProposalCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'proposal:negotiate';


    private $proposalCalcService;

    /**
     * @var ProposalService
     */
    private $proposalService;

    private $evaluationService;

    /**
     * ProposalCommand constructor.
     * @param ProposalCalculation $proposalCalcService
     * @param EvaluationService $evaluationService
     * @param ProposalService $proposalService
     */
    public function __construct(ProposalCalculation $proposalCalcService, EvaluationService $evaluationService, ProposalService $proposalService)
    {
        parent::__construct();
        $this->proposalCalcService = $proposalCalcService;
        $this->evaluationService = $evaluationService;
        $this->proposalService = $proposalService;
    }

    /**
     * Description of command
     */
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

        $proposals = [];

        for ($i=1; $i<=3; $i++) {
            $pc = $io->choice('Choose pc to evaluate', ['Dell', 'Lenovo', 'Asus']);
            $prices = $io->ask('What is the pc price?');
            $scores = $io->ask("Set scores for processor, screen, ram, certified");
            if ($this->checkScoresIsValid($scores)) {
                $proposals[] = $this->proposalService->getProposals($pc, $scores,$prices);
            }
        }


        $evaluations = $this->evaluationService->getEvaluations($proposals);
        $getTotal = $this->proposalCalcService->calculateProposalsTotal($evaluations);

        $evaluate = $this->proposalCalcService->proposalMaxScore($getTotal);

        $io->success($this->displayResult($evaluate));

        return Command::SUCCESS;
    }


    /**
     * @param $scores
     * @return bool
     * @throws \Exception
     */
    private function checkScoresIsValid($scores): bool
    {
       $explodeScores = explode(',',$scores);
       if (count($explodeScores) != 4) {
           throw new \Exception("You must enter 4 scores with comma separators");
       }

       return true;
    }

    /**
     * @param $evaluate
     * @return string
     */
    private function displayResult($evaluate): string
    {
        $output = '';
        foreach ($evaluate as $pc => $score) {
            $output =  sprintf('The preferred proposal is %s  with a score %s', $pc, $score);
        }

        return $output;
    }
}
