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

    public function authenticate()
    {
        $query = "SELECT 
                        id, name, email 
                    FROM 
                        users 
                    WHERE 
                        email = :email 
                    AND 
                        password = :password";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':password', $this->__get('password'));

        $stmt->execute();

        $return = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!empty($return)) {
            $this->__set('id', $return['id']);
            $this->__set('name', $return['name']);

            return true;
        }

        return false;
    }

    public function getAll()
    {
        $query = "SELECT 
                        u.id, u.name, u.email, 
                    (SELECT 
                        count(*) 
                    FROM 
                        users_follows 
                    AS 
                        u_f 
                    WHERE 
                        u_f.id_user = :id_user 
                    AND 
                        u_f.id_user_follow = u.id) 
                    AS 
                        follow 
                    FROM 
                        users 
                    AS 
                        u 
                    WHERE 
                        name LIKE :name 
                    AND 
                        id != :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':name', '%'.$this->__get('name').'%');
        $stmt->bindValue(':id_user', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInfoUser()
    {
        $query = "SELECT * FROM users WHERE id = :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalTweet()
    {
        $query = "SELECT count(*) as total_tweet FROM tweets WHERE id_user = :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalFollows()
    {
        $query = "SELECT count(*) as total_follows FROM users_follows WHERE id_user = :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalToFollows()
    {
        $query = "SELECT count(*) as total_to_follows FROM users_follows WHERE id_user_follow = :id_user";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id'));

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}