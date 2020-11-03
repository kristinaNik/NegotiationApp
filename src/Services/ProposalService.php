<?php


namespace App\Services;


use App\Factories\ProposalFactory;

class ProposalService
{
    /**
     * @var
     */
    private $proposal;

    /**
     * @param $pcName
     * @param $scores
     * @param $price
     * @return array
     */
    public function getProposals($pcName, $scores, $price)
    {
        $this->proposal = ProposalFactory::create($pcName, $scores, $price);

        return [
            'pcName' => $this->proposal->getPcName(),
            'scores' => $this->proposal->getScores(),
            'price' => $this->proposal->getPrice()
        ];
    }

}