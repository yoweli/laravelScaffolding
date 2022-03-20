<?php

namespace Yoweli\LaravelScaffold\Services;

use Yoweli\LaravelScaffold\Database\dbConnection;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;

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
     * @param $name
     * @return bool
     */
    private static function projectExists($name): bool
    {
        if (ProjectRepository::getProjectByName($name) === null) {
            return false;
        }
        return true;
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
        $pdo->exec("UPDATE projects SET name = '" . $name . "' WHERE id = " . $projectId);
    }

}
