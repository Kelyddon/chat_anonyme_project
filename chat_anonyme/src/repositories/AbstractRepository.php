<?php

namespace App\repositories;

use PDO;
require_once 'src/services/database.php';

abstract class AbstractRepository{
    protected $db;

    public function __construct(){
        $this->db = \App\services\getConnection();
    }
}
