<?php

namespace Yoweli\LaravelScaffold\Services;

use Yoweli\LaravelScaffold\Database\dbConnection;
use Yoweli\LaravelScaffold\Repositories\BaseRepository;

class ProjectService
{

    /**
     * @param array $input
     * @return false|void
     */
    public static function saveProject(array $input)
    {
        $pdo = (new dbConnection())->connect();
        $name = $input['name'];
        $projectExists = self::projectExists($name);

        if ($projectExists) {
            return false;
        }
        $pdo->exec("INSERT INTO projects(name) VALUES ('" . $name . "')");
    }

    /**
     * @param $projectId
     */
    public static function delete($projectId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("DELETE FROM projects WHERE id = " . $projectId);
    }

    /**
     * @param $name
     * @param $projectId
     */
    public static function update($name, $projectId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("UPDATE projects SET name = '" . $name . "' WHERE id = ". $projectId);
    }

    /**
     * @param $projectId
     */
    public static function deleteModels($projectId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("DELETE FROM models WHERE project_id = " . $projectId);
    }

    /**
     * @param $name
     * @return bool
     */
    private static function projectExists($name): bool
    {
        if (BaseRepository::getProjectByName($name) === null) {
            return false;
        }
        return true;
    }

    /**
     * @param $name
     * @return bool
     */
    private static function modelExists($name): bool
    {
        if (BaseRepository::getModelByName($name) === null) {
            return false;
        }
        return true;
    }

    /**
     * @param array $input
     * @param int $projectId
     * @return false|void
     */
    public static function saveModel(array $input, int $projectId)
    {
        $pdo = (new dbConnection())->connect();
        $name = $input['name'];
        $projectExists = self::modelExists($name);

        if ($projectExists) {
            return false;
        }

        $pdo->exec("INSERT INTO models(name, project_id) VALUES ('" . $name . "', $projectId)");
    }

    /**
     * @param $modelId
     */
    public static function deleteModel($modelId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("DELETE FROM models WHERE id = " . $modelId);
    }

    /**
     * @param $modelId
     * @return array
     */
    public static function getModel($modelId): array
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

}
