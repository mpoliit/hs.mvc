<?php


namespace Core;

use Config\Config;
use PDO;


 class AbsModel
{
    protected $tableName = '';
    protected $db = null;

    protected function getDB(){
        if ($this->db === null){
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASS);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
}