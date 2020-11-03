<?php


namespace App\Services;


use App\Factories\ScoreFactory;
use App\Models\Evaluate;
use App\Traits\PrepareDataTrait;

class EvaluationService
{
    use PrepareDataTrait;

    /**
     * @var array
     */
    private $scores = [];


    /**
     * @param $proposals
     * @return array
     */
    public function getEvaluations($proposals): array
    {
        foreach ($proposals as $proposal) {
            $preparedData = $this->prepareData($proposal['scores']);
            $this->scores[] = ScoreFactory::create($proposal['pcName'], $proposal['price'],$preparedData['processor'],
                $preparedData['screenResolution'],
                $preparedData['ram'],
                $preparedData['certified']);
        }
        return $this->scores;
    }

}