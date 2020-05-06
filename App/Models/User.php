<?php


namespace Models;


use Core\AbsModel;
use PDO;

class User extends AbsModel
{

    protected $tableName = 'users';

    public function __construct()
    {
        $this->getDB();
    }

    public function insert(array $fields)
    {
        $fields['create_at'] = date('Y-m-d H:i:s');
        $sql = "INSERT INTO $this->tableName (first_name, last_name, email, pass, birthday, create_at) VALUES (:first_name, :last_name, :email, :pass, :birthday, :create_at)";
        $fields['pass'] = password_hash($fields['pass'], PASSWORD_DEFAULT);
        $sth = $this->db->prepare($sql);
        $sth->execute($fields);

        return $this->db->lastInsertId();
    }

    public function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE email=:email";
        $sth = $this->db->prepare($sql);
        $sth->execute([':email' => $email]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        return !empty($user) ? $user : false;
    }

    public function getUserById(int $id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->execute([':id' => $id]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        return !empty($user) ? $user : false;
    }

}