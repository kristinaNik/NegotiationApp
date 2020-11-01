<?php


namespace App\Handlers;


use App\Interfaces\FileInterface;
use App\Interfaces\ValidateInterface;
use Symfony\Component\Finder\Finder;

class FileHandler implements FileInterface, ValidateInterface
{

    /**
     * @return array
     * @throws \Exception
     */
    public function getCsvData(): array
    {

        $file = $this->getFile();
        $data = [];
        if ($this->check($file)) {
            $handle = fopen($file, "r");

            while (($row = fgetcsv($handle)) !== FALSE) {
                $data[] = $row;
            }

            fclose($handle);
            unset($data[0]);
        }


        return $data;
    }

    private function getFile()
    {
        $finder = new Finder();

        $files = $finder->in('src/File')->files();
        foreach ($files as $file) {
            $path = $file->getRealPath();

        }

        return $path;
    }

    /**
     * @param string $file
     * @return bool
     * @throws \Exception
     */
    public function check(string $file): bool
    {
        if (!file_exists($file)) {
            throw new \Exception('File not found');
        }

        return true;
    }
}