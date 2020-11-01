<?php


namespace App\Handlers;


class DataHandler
{
    /**
     * @return array
     */
    public function prepareData($file) :array
    {
        list($pc, $processor, $screenResolution, $ram, $certified, $price) = $file;

        return [
            'pc'  => $pc,
            'processor' => $processor,
            'screenResolution' => $screenResolution,
            'ram' => $ram,
            'certified' => $certified,
            'price'=> $price,
        ];
    }


}