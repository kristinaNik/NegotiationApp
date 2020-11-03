<?php


namespace App\Models;


class Evaluate
{
    private $pcName;

    /**
     * @var int
     */
    private $processor;

    /**
     * @var int
     */
    private $screen;

    /**
     * @var int
     */
    private $ram;

    /**
     * @var int
     */
    private $certified;


    private $price;


    /**
     * Score constructor.
     * @param int $processor
     * @param int $screen
     * @param int $ram
     * @param int $certified
     */
    public function __construct(string $pcName,int $price, int $processor, int $screen, int $ram, int $certified)
    {
        $this->processor = $processor;
        $this->screen = $screen;
        $this->ram = $ram;
        $this->certified= $certified;
        $this->pcName = $pcName;
        $this->price = $price;
    }


    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPcName(): string
    {
        return $this->pcName;
    }

    /**
     * @return int
     */
    public function getProcessor(): int
    {
        return $this->processor;
    }

    /**
     * @return mixed
     */
    public function getScreen(): int
    {
        return $this->screen;
    }

    /**
     * @return mixed
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return mixed
     */
    public function getCertified(): int
    {
        return $this->certified;
    }


}