<?php


namespace App\Models;


class ScoreFactory
{

    /**
     * @param $processor
     * @param $screen
     * @param $ram
     * @param $certified
     * @param $price
     * @return Score
     */
    public static function create($processor, $screen, $ram, $certified): Score
    {
        return new Score($processor, $screen, $ram, $certified);

    }

}