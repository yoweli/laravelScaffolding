<?php

namespace Yoweli\LaravelScaffold\Repositories;

use Yoweli\LaravelScaffold\Database\dbConnection;

class ModelRepository
{

    /**
     * @param int $modelId
     * @return array
     */
    public static function getModel(int $modelId): array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query('SELECT * FROM models where id = ' . $modelId);
        $model = null;

        while ($row = $stmt->fetchArray()) {
            $model = [
                'id' => $row['id'],
                'name' => $row['name'],
                'project_id' => $row['project_id'],
            ];
        }
        return $model;
    }

    /**
     * @param int $projectId
     * @return array
     */
    public static function getModelsForProject(int $projectId): array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query('SELECT * FROM models where project_id = ' . $projectId);
        $models = [];

        while ($row = $stmt->fetchArray()) {
            $models[] = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $models;
    }

    /**
     * @param string $name
     * @return array|null
     */
    public static function getModelByName(string $name): ?array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query("SELECT * FROM models where name = '" . $name . "'");

        $model = null;

        while ($row = $stmt->fetchArray()) {
            $model = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $model;
    }
}
