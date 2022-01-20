<?php

namespace App\Models;

use MF\Model\Model;
use PDO;

class Tweet extends Model
{

    private $id;

    private $id_user;

    private $tweet;

    private $data;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function save()
    {
        $query = "INSERT INTO 
                        tweets (id_user, tweet) 
                    VALUES 
                        (:id_user, :tweet)";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));

        $stmt->execute();

        return $this;
    }

    public function delete()
    {
        $query = "DELETE FROM 
                        tweets
                    WHERE
                        id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();

        return true;
    }

    public function getAll()
    {
        $query = "SELECT 
                        t.id, 
                        t.id_user,
                        u.name,
                        t.tweet, 
                        DATE_FORMAT(t.data, '%d/%m/%Y %H:%i') as data
                    FROM
                        tweets as t
                    LEFT JOIN 
                        users as u
                    ON
                        t.id_user = u.id
                    WHERE
                        id_user = :id_user
                    OR
                        t.id_user
                    IN
                        (SELECT
                            id_user_follow
                        FROM
                            users_follows
                        WHERE 
                            id_user = :id_user)
                    ORDER BY
                        t.data DESC";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':id_user', $this->__get('id_user'));

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
