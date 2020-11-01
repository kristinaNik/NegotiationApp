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
        foreach ($proposals as $pc => $scores) {
            $preparedData = $this->prepareData($scores);
            $this->scores[$pc] = ScoreFactory::create($preparedData['processor'],
                $preparedData['screenResolution'],
                $preparedData['ram'],
                $preparedData['certified']);

        }

    }

    /**
     * @param $prices
     * @return array
     */
    public function calculateScoreTotal($prices): array
    {
        $totals = [];
        foreach ($this->scores as $pc => $score) {
            foreach ($prices as $pcName => $price) {
                if ($pcName === $pc) {
                    $processor = ($score->getProcessor() * ($this->criteria->getProcessorWeight()/100)*100);
                    $screen =  ($score->getScreen() * ($this->criteria->getScreenResolutionWeight()/100)*100);
                    $ram = ($score->getRam() * ($this->criteria->getRamWeight()/100) *100);
                    $certified = ($score->getCertified() * ($this->criteria->getCertifiedWeight()/100)*100);

                    $sum = $processor + $screen + $ram + $certified + $price;

                    $totals[$pc] = $sum;
                }
            }

        }

        return $totals;

    }

    /**
     * @param $prices
     * @return array
     */
    public function calculatePrice($prices): array
    {
        $totals = [];
        $minPrice = min($prices);
        foreach ($prices as $pc => $price) {
            $pp = 100 * ($minPrice/$price);
            $totals[$pc] = round($pp,0);
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