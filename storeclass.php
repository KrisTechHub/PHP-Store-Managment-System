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

    public function openConnection() { //connect with database
        try { //try catch method
            $this->con = new PDO($this->server, $this->user, $this->password, $this->options);
            return $this->con;
        } catch(PDOException $e) {
            echo "There is some problem with the connection :" . $e->getMessage();
        }
    }

    public function closeconnection(){ //close connection with database.
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
    


    public function login() {  //login function, use md5 for encryption
        if(isset($_POST['submit'])) {
            $password = md5($_POST['password']);
            $email = $_POST['email'];
            
            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM members WHERE email = ? AND  password = ? ");
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch(); //access individual info of members in database
            $total = $stmt -> rowCount();

            if ($total > 0) {
                echo "Welcome " .$user['first_name']." ".$user['last_name'] . "!";
                $this->set_userdata($user);
            } else {
                echo "Login Failed";
            }
        }
    }



    public function set_userdata($array) {
        if (!isset($_SESSION)) { //check if session is set
            session_start();
        }

        $_SESSION['userdata'] = array(
            "fullname" => $array['first_name']." ".$array['last_name'],
            "access" => $array['access']
        );
        return $_SESSION['userdata'];
    }



    public function get_userdata() {
        if (!isset($_SESSION)) { //check if session is set
            session_start();
        }

        if(isset($_SESSION['userdata'])) {
            return $_SESSION['userdata'];
        }else {
            return null;
        }
    }



    public function logout() {

        if (!isset($_SESSION)) { //check if session is set
            session_start();
        }
        $_SESSION['userdata'] = null;
        unset($_SESSION['userdata']);
    }



    public function checkUserExist($email) { //if user exists. error persists
        
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM members WHERE email = ? ");
        $stmt->execute([$email]);
        $total = $stmt -> rowCount();

        return $total;
    }



    public function addNewUser() { //create account function
        
        if (isset($_POST['add'])) {

            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];

            if($this->checkUserExist($email) == 0){
                $connection = $this->openConnection();
                $stmt = $connection->prepare("INSERT INTO members(`email`, `password`, `first_name`, `last_name`, `mobile`, `address`)VALUES(?,?,?,?,?,?) ");
                $stmt->execute([$email, $password, $fname, $lname, $mobile, $address]);
            } else {
                echo "User alrady exists!";
            }
        } 
    }
}

$store = new MyStore();


?>