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
        return include PROJECT_ROOT . '/db/artifacts.php';
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
}
