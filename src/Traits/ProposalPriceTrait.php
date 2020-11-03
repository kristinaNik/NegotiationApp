<?php


namespace App\Traits;


trait ProposalPriceTrait
{

    /**
     * @param $proposals
     * @return mixed
     */
    public function getMinProposalsPrice($proposals)
    {
        $prices = [];
        foreach ($proposals as $proposal) {
            $prices[] = $proposal->getPrice();
        }

        return min($prices);
    }

}