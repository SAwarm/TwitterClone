<?php

namespace App\Models;

use MF\Model\Model;
use PDO;

class User extends Model {
    
    private $id;

    private $name;

    private $email;

    private $password;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function store()
    {
        $query = "INSERT INTO 
                        users (name, email, password)
                    VALUES (:name, :email, :password)";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':name', $this->__get('name'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':password', $this->__get('password'));

        $stmt->execute();

        return true;
    }

    public function validationRegister()
    {
        $validate = true;

        if (strlen($this->__get('name') < 3)) {
            $validate = false;
        }

        if (strlen($this->__get('email') < 3)) {
            $validate = false;
        }

        if (strlen($this->__get('password') < 3)) {
            $validate = false;
        }

        return $validate;
    }

    public function getUserEmail()
    {
        $query = "SELECT 
                        name, email 
                    FROM
                        users 
                    WHERE
                        email = :email";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':email', $this->__get('email'));

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}