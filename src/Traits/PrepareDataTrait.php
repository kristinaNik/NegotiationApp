<?php


namespace App\Traits;


trait PrepareDataTrait
{
    /**
     * @param $data
     * @return array
     */
    public function prepareData($data): array
    {

        $explodeData = explode(',', $data);
        list($processor, $screenResolution, $ram, $certified) = $explodeData;
        return [
            'processor' => (int)$processor,
            'screenResolution' => (int)$screenResolution,
            'ram' => (int)$ram,
            'certified' => (int)$certified,
        ];
    }


}