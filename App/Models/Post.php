<?php


namespace Models;


use Core\AbsModel;
use PDO;

class Post extends AbsModel
{

    protected $tableName = 'posts';

    public function __construct()
    {
        $this->getDB();
    }

    public function insert(array $fields)
    {
        $fields['create_at'] = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $this->tableName (user_id, title, content, image, create_at) VALUES (:user_id, :title, :content, :image, :create_at)";
        $sth = $this->db->prepare($sql);
        $sth->execute($fields);

        return $this->db->lastInsertId();
    }

    public function selectPostById(int $id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE  id = :id";
        $sth = $this->db->prepare($sql);
        $sth->execute([':id' => $id]);
        $post = $sth->fetch(PDO::FETCH_ASSOC);

        return !empty($post) ? $post : false;
    }

    public function selectAllPost()
    {

        $sql = "
            SELECT * FROM 
                $this->tableName
            ORDER BY 
                id
            ";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $post = $sth->fetchAll(PDO::FETCH_ASSOC);

        return !empty($post) ? $post : false;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM $this->tableName WHERE  id = :id";
        $sth = $this->db->prepare($sql);
        $sth->execute([':id' => $id]);

        return;
    }

    public function update(array $fields)
    {
        $img = isset($fields['image']) ? ', image=:image' : '';

        $sql = "UPDATE $this->tableName SET title=:title, content=:content $img  WHERE id=:id";

        $sth = $this->db->prepare($sql);
        $result = $sth->execute($fields);

        return $result;
    }

    public function selectPostByUserId(int $user_id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE  user_id = :user_id";
        $sth = $this->db->prepare($sql);
        $sth->execute([':user_id' => $user_id]);
        $post = $sth->fetchAll(PDO::FETCH_ASSOC);

        return !empty($post) ? $post : false;
    }

}