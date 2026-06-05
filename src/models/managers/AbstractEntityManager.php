<?php

namespace Models\Managers;
use Models\Database;

abstract class AbstractEntityManager
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
}