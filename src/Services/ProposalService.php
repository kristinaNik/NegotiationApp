<?php


namespace App\Services;


use App\Handlers\DataHandler;
use App\Models\Score;
use App\Models\ScoreFactory;

class ProposalService extends DataHandler
{

    /**
     * @var array
     */
    private $fileData = [];

    /**
     * @param $csvData
     *
     * @throws \Exception
     */
    public function setData($csvData): void
    {
        foreach ($csvData as $key => $data) {
            $this->fileData[$data[0]] = $this->prepareData($data);
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->fileData;
    }

    /**
     * @param $arg
     */
    public function checkProposalArgument($arg)
    {

        foreach ($this->fileData as $key => $value) {
            if ($key === $arg) {
                $this->evaluate();
            }
        }

    }

    /**
     * @return Score
     */
    private function evaluate()
    {
      return ScoreFactory::create(15,10,10,10,5);
    }

}