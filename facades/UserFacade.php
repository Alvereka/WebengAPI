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
            $user[$i]['passowrd'] = $pass;
            $i++;
        }
        return $user;
    }
    public function isUserExist($username)
    {
        $stmt = $this->conn->prepare("SELECT status FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0; // tidak ada = true
    }
    
    public function createUser($gender, $pass, $email, $name, $phone, $status)
    {
        if (!$this->isUserExist($name)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO user (username, pass, email, gender, status, telepon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssis", $name, $password, $email, $gender, $status, $phone);
            if ($stmt->execute()) {
                return USER_CREATED;
            } else {
                return USER_NOT_CREATED;
            }
        } else {
            return USER_ALREADY_EXIST;
        }
    }

    public function updateUser($gender, $pass, $email, $username, $phone, $status)
    {
        if (!$this->isUserExist($username)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("UPDATE user SET  pass=? , gender=?, status=?, phone=? WHERE username=? OR Email=? ");
            $stmt->bind_param("ssisss",  $pass,  $gender, $status, $phone,$username,$email);
            if ($stmt->execute()) {
                return USER_UPDATED;
            } else {
                return USER_NOT_UPDATED;
            }
        } else {
            return USER_TIDAK_DITEMUKAN;
        }
    }
    public function getSingleUser($email, $username){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email=? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
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
            $user[$i]['passowrd'] = $pass;
            $i++;
        }
        return $user;
    }
    
    public function getSingleUserPassword($username, $password){

        $pass = md5($password);
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE (email=? OR username = ?) AND pass = ?");
        $stmt->bind_param("sss", $username, $username, $pass);
        $stmt->execute();
        // URUT YA BOSKUUUU
        $stmt->bind_result($emails, $passw, $uname, $gender, $status, $phone);

        $user = array();
        $i=0;
        while($data = $stmt->fetch()){
            $user[$i]['username'] = $uname;
            $user[$i]['email'] = $emails;
            $user[$i]['phone'] = $phone;
            $user[$i]['status'] = $status;
            $user[$i]['gender'] = $gender;
            $user[$i]['passowrd'] = $passw;
            $i++;
        }
        return $user;
    }
    
    public function deleteUser($email, $username)
    {
        if (!$this->isUserExist($username)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("DELETE FROM user WHERE username=$username ");
            $stmt->bind_param("s", $username);
            if ($stmt->execute()) {
                return USER_DELETED;
            } else {
                return USER_NOT_DELETED;
            }
        } else {
            return USER_TIDAK_DITEMUKAN;
        }
    }


}

?>