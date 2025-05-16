<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'photo_gallery';
    private $username = 'root';  
    private $password = '';  
    public $db;

    public function getConnection() {
        $this->db= null;
        
            $this->db = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $this->db;
    }

}
?>
