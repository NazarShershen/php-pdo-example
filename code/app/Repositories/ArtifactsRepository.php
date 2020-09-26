<?php


namespace App\Repositories;

use App\Artifact;
use App\DB\DB;
use PDO;

class ArtifactsRepository
{
    private $db;

    private $table = 'artifacts';

    private $metadataTable = 'artifacts_metadata';

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
//        return $stmt->fetchAll(PDO::FETCH_OBJ);
        $artifactsData = $stmt->fetchAll();

        $artifactsCollection = $this->mapArtifacts($artifactsData);

        return $artifactsCollection;
    }

    public function find(int $id)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1", [$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create(array $artifactInfo)
    {
        $sql = "INSERT INTO {$this->table} (title, flavour_text, modifiers, image_url, price)
                VALUES (:title, :flavour_text, :modifiers, :image_url, :price)";

        $data = [
            ':title' => htmlentities($artifactInfo['title']),
            ':flavour_text' => htmlentities($artifactInfo['flavour_text']),
            ':modifiers' => serialize($artifactInfo['modifiers']),
            ':image_url' => $artifactInfo['image_url'],
            ':price' => $artifactInfo['price'],
        ];

        $this->db->query($sql, $data);

        $createdArtifactId = $this->db->getLastInsertedId();

        if (isset($artifactInfo['attributes'])) {
            $sql = "INSERT INTO {$this->metadataTable} (artifact_id, name, value) VALUES (:artifact_id, :name, :value)";

            //TODO Save multiple attributes with single insert query
        }

        return $createdArtifactId;
    }

    public function remove(int $id)
    {
        return $this->db->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    private function fetchAttributes(int $artifactId)
    {
        $stmt = $this->db->query("SELECT id, name, value FROM {$this->metadataTable} WHERE artifact_id = ?", [$artifactId]);
        return $stmt->fetchAll();
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
            $artifact['title'] = html_entity_decode($artifact['title']);
            $artifact['flavour_text'] = html_entity_decode($artifact['flavour_text']);
            $artifact['modifiers'] = unserialize($artifact['modifiers']);
            $artifact['attributes'] = $this->fetchAttributes($artifact['id']);
            $artifactsCollection[] = new Artifact($artifact);
        }

        return $artifactsCollection;
    }
}
