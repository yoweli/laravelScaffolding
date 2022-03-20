<?php

namespace Yoweli\LaravelScaffold\Services;

use Yoweli\LaravelScaffold\Database\dbConnection;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;
use Yoweli\LaravelScaffold\Repositories\ModelRepository;

class ModelService
{

    /**
     * @param $modelId
     */
    public static function deleteModel($modelId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("DELETE FROM models WHERE id = " . $modelId);
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
     * @param $name
     * @return bool
     */
    public static function modelExists($name): bool
    {
        if (ModelRepository::getModelByName($name) === null) {
            return false;
        }
        return true;
    }

    /**
     * @param $projectId
     */
    public static function deleteModels($projectId)
    {
        $pdo = (new dbConnection())->connect();
        $pdo->exec("DELETE FROM models WHERE project_id = " . $projectId);
    }
}
