<?php


namespace Core;


 class AbsModel
{
    protected $tableName = '';
    protected $db = null;
    private $congig = [];

    public function __construct()
    {
//        $config_array = [
//            'DB_HOST' => 'localhost',
//            'DB_NAME' => 'hs_mvc',
//            'DB_CHARSET' => 'utf8',
//            'DB_USER' => 'root',
//            'DB_PASS' => ''
//        ];
//        $config_array = serialize($config_array);
//        file_put_contents(dirname(__DIR__) . '/config/db', $config_array);

        $config = file_get_contents(dirname(__DIR__) . '/config/db');
        $this->congig = unserialize($config);
    }

    protected function getDB(){
        if ($this->db === null){
            $config = $this->congig;
            $dsn = 'mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_NAME'] . ';charset=' . $config['DB_CHARSET'];
            $this->db = new PDO($dsn, $config['DB_USER'], $config['DB_PASS']);

            $this->db->setAttribute(PDO::ATTR_ERMODE, PDO::ERMODE_EXCEPRION);
        }
    }
}