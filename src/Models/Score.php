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
     * Score constructor.
     * @param int $processor
     * @param int $screen
     * @param int $ram
     * @param int $certified
     */
    public function __construct(int $processor, int $screen, int $ram, int $certified)
    {
        $this->processor = $processor;
        $this->screen = $screen;
        $this->ram = $ram;
        $this->certified= $certified;
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