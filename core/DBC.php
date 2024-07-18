<?php
// zeko database class 
class DBC
{
    private $path;

    public function __construct()
    {
        $this->path = __DIR__."\database\\";
    }

    public  function get($fileName)
    {
        $filePath = $this->path . $fileName . ".json";
        if (file_exists($filePath)) {
            $file = file_get_contents($filePath);
            return json_decode($file, true) ?? [];
        } else {
            return [];
        }
    }

    public function set($fileName, $data): bool
    {
        $filePath = $this->path . $fileName . ".json";
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents($filePath, $jsonData) === false) {
            return false;
        }

        return true;
    }

    public function add($fileName, $data): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            $currentData = [];
        }

        // if (is_array($data)) {
        //     // $currentData = array_merge($currentData, $data);
        //     return false;
        // } else {
        // }
        $currentData[] = $data;

        return $this->set($fileName, $currentData);
    }

    public function remove($fileName,int $id): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            echo "Error: Data is not an array";
            return false;
        }

        foreach ($currentData as $key => $value) {
            if (isset($value['id']) && $value['id'] == $id) {
                unset($currentData[$key]);
                return $this->set($fileName, array_values($currentData));
            }
        }

        return false;
    }

    public function update($fileName, $id, $newData): bool
    {
        $currentData = $this->get($fileName);

        if (!is_array($currentData)) {
            echo "Error: Data is not an array";
            return false;
        }

        foreach ($currentData as $key => $value) {
            if (isset($value['id']) && $value['id'] == $id) {
                $currentData[$key] = array_merge($currentData[$key], $newData);
                return $this->set($fileName, $currentData);
            }
        }

        return false;
    }
}
