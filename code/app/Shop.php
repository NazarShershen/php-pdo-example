<?php

namespace App;

use App\DB\DB;
use App\Repositories\ArtifactsRepository;

class Shop
{
    public $goods = [];

    private $repository;

    /**
     * Shop constructor.
     * @param ArtifactsRepository $repository
     */
    public function __construct(ArtifactsRepository $repository)
    {
        $this->repository = $repository;
        $this->loadGoods();
    }

    public function getShopItem(int $id)
    {
        $artifact = $this->repository->find($id);
        return $artifact;
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
        $this->goods = $this->repository->all();
//        dd($this->goods);
    }

    /**
     * Get data from db file
     *
     * @return array
     */
    private function getDataFromJson(): array
    {
        $artifactsJson = file_get_contents($this->getStoragePath());
        return json_decode($artifactsJson, true);
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
