<?php


namespace App\Factories;


use App\Models\Proposal;

class ProposalFactory
{

    /**
     * @param $pcName
     * @param $score
     * @param $price
     * @return Proposal
     */
    public static function create($pcName, $score, $price)
    {
        return new Proposal($pcName, $score, $price);

    }
}