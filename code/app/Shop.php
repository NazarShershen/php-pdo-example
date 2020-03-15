<?php

namespace App;

class Shop
{
    public $goods = [];

    /**
     * Shop constructor.
     */
    public function __construct()
    {
        $this->loadGoods();
    }

    /**
     * Goods attribute getter
     *
     * @return array
     */
    public function getGoods(): array
    {
        return $this->goods;
    }

    /**
     * Goods attributes setter
     *
     * @param array $value
     */
    public function setGoods(array $value): void
    {
        $this->goods = $value;
    }

    /**
     * Add new item to shop storage
     *
     * @param Artifact $item
     */
    public function addNewItem(Artifact $item)
    {
        $this->goods[] = $item;
        $this->saveGoods();
    }

    /**
     * Save goods to storage
     */
    public function saveGoods(): void
    {
        $arrayOfGoods = array_map(function ($item) {
            return $item->toArray();
        }, $this->goods);

        file_put_contents($this->getStoragePath(), json_encode($arrayOfGoods, [JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES]));
        $this->loadGoods();
    }

    /**
     * Method to load shop items
     *
     * @return void
     */
    private function loadGoods(): void
    {
        $artifactsData = $this->getDataFromDb();
        $this->goods = $this->mapArtifacts($artifactsData);
    }

    /**
     * Get data from db file
     *
     * @return array
     */
    private function getDataFromDb(): array
    {
        $artifactsJson = file_get_contents($this->getStoragePath());
        return json_decode($artifactsJson, true);
    }

    /**
     * Map retrieved data to Artifact objects
     *
     * @param array $artifacts
     * @return array
     */
    private function mapArtifacts(array $artifacts): array
    {
        $artifactsCollection = [];
        foreach ($artifacts as $artifact) {
            $artifactsCollection[] = new Artifact($artifact);
        }

        return $artifactsCollection;
    }

    /**
     * Get path to storage file
     *
     * @return string
     */
    private function getStoragePath(): string
    {
        return PROJECT_ROOT . '/db/artifacts.json';
    }
}
