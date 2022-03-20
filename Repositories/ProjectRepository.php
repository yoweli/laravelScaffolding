<?php

namespace Yoweli\LaravelScaffold\Repositories;

use Yoweli\LaravelScaffold\Database\dbConnection;

/**
 * class ProjectRepository
 */
class ProjectRepository
{

    /**
     * @return array
     */
    public static function getAllProjects(): array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query('SELECT * FROM projects');
        $projects = [];

        while ($row = $stmt->fetchArray()) {
            $projects[] = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $projects;
    }

    /**
     * @param int $projectId
     * @return array|null
     */
    public static function getProject(int $projectId): ?array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query('SELECT * FROM projects where id = ' . $projectId);
        $project = null;

        while ($row = $stmt->fetchArray()) {
            $project = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $project;
    }

    /**
     * @param string $name
     * @return array|null
     */
    public static function getProjectByName(string $name): ?array
    {
        $pdo = (new dbConnection())->connect();
        $stmt = $pdo->query("SELECT * FROM projects where name = '" . $name . "'");

        $project = null;

        while ($row = $stmt->fetchArray()) {
            $project = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $project;
    }

}
