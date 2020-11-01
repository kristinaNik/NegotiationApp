<?php


namespace App\Factories;

use App\Models\Score;

class ScoreFactory
{

    /**
     * @param $processor
     * @param $screen
     * @param $ram
     * @param $certified
     * @return Score
     */
    public static function create($processor, $screen, $ram, $certified): Score
    {
        return new Score($processor, $screen, $ram, $certified);

    }

}