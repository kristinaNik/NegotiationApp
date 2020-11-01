<?php


namespace App\Services;

use App\Factories\CriteriaFactory;
use App\Factories\ScoreFactory;
use App\Traits\PrepareDataTrait;

class EvaluationService
{
    use PrepareDataTrait;


    /**
     * @var
     */
    private $scores = [];

    /**
     * @var array
     */
    private $criteria;

    /**
     * EvaluationService constructor.
     */
    public function __construct()
    {
        $this->criteria = CriteriaFactory::create(15, 10,10,5);
    }

    /**
     * @param $proposals
     */
    public function setScoreCriteria($proposals): void
    {
        foreach ($proposals as $key => $proposal) {
            $preparedData = $this->prepareData($proposal);
            $this->scores[$key] = ScoreFactory::create($preparedData['processor'],
                $preparedData['screenResolution'],
                $preparedData['ram'],
                $preparedData['certified']);

        }

    }

    /**
     * @return array
     */
    public function calculateScoreTotal(): array
    {

        $totals = [];
        foreach ($this->scores as $pc => $score) {
            $processor = ($score->getProcessor() * ($this->criteria->getProcessorWeight()/100)*100);
            $screen =  ($score->getScreen() * ($this->criteria->getScreenResolutionWeight()/100)*100);
            $ram = ($score->getRam() * ($this->criteria->getRamWeight()/100) *100);
            $certified = ($score->getCertified() * ($this->criteria->getCertifiedWeight()/100)*100);

            $sum = $processor + $screen + $ram + $certified;

            $totals[$pc] = $sum;
        }

        return $totals;

    }

    /**
     * @param $totals
     * @return array
     */
    public function evaluateMaxScore($totals): array
    {
        $winner = [];
        $getMaxTotal = max($totals);
        $pc = array_search($getMaxTotal, $totals);
        $winner[$pc] = $getMaxTotal;

        return $winner;
    }

}