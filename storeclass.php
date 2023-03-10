<?php

Class MyStore {

    //private can only be accessed inside ccurly braces or inside the class.
    //public function can access all data inside the class
    //protected can access var and function inside the sub functions(public), but cannot access outside
    //protected is used in php packages deployed in different servers, also uses $this

    private $server = "mysql:host=localhost;dbname=mystore";
    private $user = "root"; 
    private $password = "Tiggy.143";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC); //:: is resolution oeprator, first way of PHP to access (line .(dot) in js)
    protected $con;

    public function openConnection() { 
        try { //try catch method
            $this->con = new PDO($this->server, $this->user, $this->password, $this->options);
            return $this->con;
        } catch(PDOException $e) {
            echo "There is some problem with the connection :" . $e->getMessage();
        }
    }

    public function closeconnection(){ //to optimize program, need to close connection.
        $this->con = null;
    }

    public function getUsers() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM members");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $userCount = $stmt->rowCount();

        if($userCount > 0) {
            return $users;
        } else {
            return 0;
        }
    }

};

?>