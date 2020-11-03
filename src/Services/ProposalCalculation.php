<?php


namespace App\Services;

use App\Factories\CriteriaFactory;
use App\Traits\ProposalPriceTrait;

class ProposalCalculation
{
   use ProposalPriceTrait;

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
     * @param $evaluations
     * @return array
     */
    public function calculateProposalsTotal($evaluations): array
    {
        $totals = [];
        $minPrices = $this->getMinProposalsPrice($evaluations);
        foreach ($evaluations as $evaluation) {
            $processor = ($evaluation->getProcessor() * ($this->criteria->getProcessorWeight()/100)*100);
            $screen =  ($evaluation->getScreen() * ($this->criteria->getScreenResolutionWeight()/100)*100);
            $ram = ($evaluation->getRam() * ($this->criteria->getRamWeight()/100) *100);
            $certified = ($evaluation->getCertified() * ($this->criteria->getCertifiedWeight()/100)*100);
            $priceProposal = 100 * ($minPrices/$evaluation->getPrice());
            $sum = $processor + $screen + $ram + $certified + round($priceProposal);

            $totals[$evaluation->getPcName()] = $sum;
        }

        return $totals;

    }

    /**
     * @param $totals
     * @return array
     */
    public function proposalMaxScore($totals): array
    {
        $winner = [];
        $getMaxTotal = max($totals);
        $pc = array_search($getMaxTotal, $totals);
        $winner[$pc] = $getMaxTotal;

        return $winner;
    }

}