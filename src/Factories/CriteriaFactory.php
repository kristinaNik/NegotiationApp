<?php


namespace App\Factories;


use App\Models\Criteria;

class CriteriaFactory
{
    /**
     * @param $processorWeight
     * @param $screenResolutionWeight
     * @param $ramWeight
     * @param $certifiedWeight
     * @return Criteria
     */
    public static function create($processorWeight, $screenResolutionWeight, $ramWeight, $certifiedWeight): Criteria
    {
        return new Criteria($processorWeight, $screenResolutionWeight, $ramWeight, $certifiedWeight);
    }

}