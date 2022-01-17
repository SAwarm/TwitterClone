<?php

namespace App\Models;

use MF\Model\Model;

class UserToFollow extends Model
{
    private $id;

    private $id_user;

    private $id_user_follow;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function follow()
    {
        $query = "INSERT INTO users_follows (id_user, id_user_follow) VALUES (:id_user, :id_user_follow)";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->bindValue(':id_user_follow', $this->__get('id_user_follow'));

        $stmt->execute();

        return true;
    }

    public function unfollow()
    {
        $query = "DELETE FROM users_follows where id_user = :id_user AND id_user_follow = :id_user_follow";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->bindValue(':id_user_follow', $this->__get('id_user_follow'));

        $stmt->execute();

        return true;
    }
}