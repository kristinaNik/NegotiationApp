<?php


namespace App\Models;


class Score
{

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

    /**
     * @var int
     */
    private $price;

    /**
     * Score constructor.
     * @param int $processor
     * @param int $screen
     * @param int $ram
     * @param int $certified
     * @param int $price
     */
    public function __construct(int $processor, int $screen, int $ram, int $certified, int $price)
    {
        $this->processor = $processor;
        $this->screen = $screen;
        $this->ram = $ram;
        $this->certified= $certified;
        $this->price = $price;
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

    /**
     * @return mixed
     */
    public function getPrice(): int
    {
        return $this->price;
    }

}