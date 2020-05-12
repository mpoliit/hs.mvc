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

    public function update(array $fields){
        $pass = '';
        if (isset($fields['new_pass'])){
            $fields['pass'] = password_hash($fields['new_pass'], PASSWORD_DEFAULT);
            $pass = ', pass=:pass';
            unset($fields['new_pass']);
        }
        $sql = "
            UPDATE 
                $this->tableName
            SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                birthday = :birthday
                $pass
            WHERE
                id=:id
                ";
        $sth = $this->db->prepare($sql);
        $sth->execute($fields);

        return $this->db->lastInsertId();
    }

    public function getUserEmailExeptThisUser(string $email, int $id)
    {
        $sql = "SELECT COUNT(*) AS emails FROM $this->tableName WHERE id!=:id AND email=:email";
        $sth = $this->db->prepare($sql);
        $sth->execute([':id' => $id,
                        ':email' => $email]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        return ($user['emails']>0) ? false : true;
    }

    public function insertSecretKey()
    {
        $sql = "UPDATE $this->tableName SET secret_key=:secret_key WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->execute(['secret_key' => $_SESSION['qr']['secret'],
                        'id' => $_SESSION['qr']['user_id']]);

        return $this->db->lastInsertId();
    }

}