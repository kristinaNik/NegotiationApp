<?php


namespace App\Services;

use App\Handlers\DataHandler;
use App\Models\ScoreFactory;

class EvaluationService extends DataHandler
{
    /**
     * @var
     */
    private $scores = [];

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
        $sum = 0;
        foreach ($this->scores as $pc => $score) {
            $sum += $score->getProcessor() + $score->getScreen() + $score->getRam() + $score->getCertified();

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