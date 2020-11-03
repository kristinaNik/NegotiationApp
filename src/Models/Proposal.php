<?php


namespace App\Models;


class Proposal
{
    private $pcName;

    private $scores;

    private $price;

    public function __construct($pcName, $scores, $price)
    {
        $this->pcName = $pcName;
        $this->scores = $scores;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPcName()
    {
        return $this->pcName;
    }

    /**
     * @return mixed
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

}