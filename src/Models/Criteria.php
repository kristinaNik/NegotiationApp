<?php


namespace App\Models;


class Criteria
{

    /**
     * @var int
     */
    private $processorWeight;

    /**
     * @var int
     */
    private $screenResolutionWeight;

    /**
     * @var int
     */
    private $ramWeight;

    /**
     * @var int
     */
    private $certifiedWeight;


    /**
     * CriteriaService constructor.
     * @param int $processorWeight
     * @param int $screenResolutionWeight
     * @param int $ramWeight
     * @param int $certifiedWeight
     */
    public function __construct(int $processorWeight, int $screenResolutionWeight, int $ramWeight, int $certifiedWeight)
    {
        $this->processorWeight = $processorWeight;
        $this->screenResolutionWeight = $screenResolutionWeight;
        $this->ramWeight = $ramWeight;
        $this->certifiedWeight = $certifiedWeight;
    }

    /**
     * @return int
     */
    public function getProcessorWeight(): int
    {
        return $this->processorWeight;
    }

    /**
     * @return int
     */
    public function getScreenResolutionWeight(): int
    {
        return $this->screenResolutionWeight;
    }

    /**
     * @return int
     */
    public function getRamWeight(): int
    {
        return $this->ramWeight;
    }


    /**
     * @return int
     */
    public function getCertifiedWeight(): int
    {
        return $this->certifiedWeight;
    }



}