<?php

namespace Yoweli\LaravelScaffold\Repositories;

use Yoweli\LaravelScaffold\Database\dbConnection;

class BaseRepository
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
     * @param $projectId
     * @return array|null
     */
    public static function getProject($projectId): ?array
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
     * @param $name
     * @return array|null
     */
    public static function getProjectByName($name): ?array
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

    /**
     * @param $projectId
     * @return array
     */
    public static function getModelsForProject($projectId): array
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
     * @param $name
     * @return array|null
     */
    public static function getModelByName($name): ?array
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
