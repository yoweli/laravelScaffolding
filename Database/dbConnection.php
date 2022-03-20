<?php

namespace Yoweli\LaravelScaffold\Database;

use SQLite3;

class dbConnection
{
    private $pdo;

    /**
     * @return SQLite3
     */
    public function connect(): SQLite3
    {
        if ($this->pdo == null) {
            $this->pdo = new SQLite3('data.db');
            $this->addTables();
        }
        return $this->pdo;
    }

    /**
     * Add package tables
     */
    private function addTables()
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS projects (id INTEGER PRIMARY KEY AUTOINCREMENT, name CHAR)');
        $this->pdo->query('CREATE TABLE IF NOT EXISTS models (id INTEGER PRIMARY KEY AUTOINCREMENT, project_id INTEGER, name CHAR)');
    }
}
