<?php

class UserFacade{

    private $conn;
    function __construct(){
        require dirname(__FILE__)."/../connection.php";

        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function getUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        // URUT YA BOSKUUUU
        $stmt->bind_result($email, $pass, $uname, $gender, $status, $phone);
        $user = array();
        $i=0;
        while($data = $stmt->fetch()){
            $user[$i]['username'] = $uname;
            $user[$i]['email'] = $email;
            $user[$i]['phone'] = $phone;
            $user[$i]['status'] = $status;
            $user[$i]['gender'] = $gender;
            $i++;
        }
        return $user;
    }
    


}

?>