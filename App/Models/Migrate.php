<?php


namespace Models;


use Core\AbsModel;

class Migrate extends AbsModel
{

    public function __construct()
    {
        $this->getDB();
    }

    public function migrate(string $query)
    {
        $fields['create_at'] = date('Y-m-d H:i:s');
        $sql = "$query";
        $sth = $this->db->prepare($sql);
        $sth->execute();

        return;
    }
}