<?php
// DBC class definition 
class DBC 
{
    private $path;

    public function __construct()
    {
        $this->path = __DIR__ . "\\database2\\";
    }

    public function get($fileName)
    {
        $filePath = $this->path . $fileName . ".txt";
        if (file_exists($filePath)) {
            $res = [];
            $line = file($filePath);
            foreach ($line as $row) {
               $item = explode("|", trim($row));
               $ru = [];
               foreach ($item as $key => $value) {
                $itemArr = explode('::', $value); 
                if (count($itemArr) === 2) {
                    $ru[$itemArr[0]] = $itemArr[1];
                }
               }
                $res[] = $ru; 
            }
            return $res;
        } else {
            return [];
        }
    }

    public function set($fileName,array $data): bool
    {
        $filePath = $this->path . $fileName . ".txt";
        $fileContent = "";

        foreach ($data as $item) {
            $line = "";
            foreach ($item as $key => $value) {
                $line .= "{$key}::{$value}|";
            }
            $fileContent .= rtrim($line, "|") . PHP_EOL;
        }

        $file = fopen($filePath, 'w');
        if ($file === false) {
            return false; 
        }

        $result = fwrite($file, $fileContent);
        if ($result === false) {
            fclose($file); 
            return false;
        }

        fclose($file); 
        return true; 
    }

    public function add($fileName, $data): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            $currentData = [];
        }

        $currentData[] = $data;

        return $this->set($fileName, $currentData);
    }

    public function remove($fileName, int $id): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            echo "Error: Data is not an array";
            return false;
        }

        $filteredData = array_filter($currentData, function($item) use ($id) {
            return !isset($item['id']) || $item['id'] != $id;
        });

        return $this->set($fileName, array_values($filteredData));
    }

    public function update($fileName, $id, $newData): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            echo "Error: Data is not an array";
            return false;
        }

        $updatedData = array_map(function($item) use ($id, $newData) {
            if (isset($item['id']) && $item['id'] == $id) {
                return array_merge($item, $newData);
            }
            return $item;
        }, $currentData);

        return $this->set($fileName, $updatedData);
    }
}
?>
