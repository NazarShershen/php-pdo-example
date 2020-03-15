<?php

namespace App;

class Shop
{
    /**
     * Method to retrieve shop items
     *
     * @return array
     */
    public function getGoods(): array
    {
        $artifactsData = $this->getDataFromDb();
        return $this->mapArtifacts($artifactsData);
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
    private function getStoragePath()
    {
        return PROJECT_ROOT . '/db/artifacts.json';
    }
}
