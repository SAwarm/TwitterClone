<?php

namespace App\Models;

use PDO;

class Info {

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getInfo()
    {
        $query = "SELECT 
                        id,
                        titulo,
                        descricao
                    FROM
                        tb_info";

        return $this->db->query($query)->fetchAll();
    }
}