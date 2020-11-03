<?php


namespace App\Factories;

use App\Models\Evaluate;

class ScoreFactory
{

    /**
     * @param $processor
     * @param $screen
     * @param $ram
     * @param $certified
     * @return Evaluate
     */
    public static function create($pcName, $price, $processor, $screen, $ram, $certified): Evaluate
    {
        return new Evaluate($pcName, $price, $processor, $screen, $ram, $certified);

    }

}