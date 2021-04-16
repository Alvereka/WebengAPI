<?php

    class UserController{

        public $fcd;
        function __construct(){
            require dirname(__FILE__).'/../facades/UserFacade.php';
            require dirname(__FILE__).'/../Constants.php';
            
            $this->fcd = new UserFacade();
        }

        public function getUser()
        {
            return $this->fcd->getUser();
        }
        public function createUser($gender, $pass, $email, $name, $phone, $status)
        {
            return $this->fcd->createUser($gender, $pass, $email, $name, $phone, $status);
        }
        public function updateUser($gender, $pass, $email, $name, $phone, $status)
        {
            return $this->fcd->updateUser($gender, $pass, $email, $name, $phone, $status);
        }
        public function deleteUser($email,$username)
        {
            return $this->fcd->deleteUser($email,$username);
        }
        public function getSingleUser($email,$username)
        {
            return $this->fcd->getSingleUser($email,$username);
        }
        public function login($username,$pass){
            if($this->fcd->isUserExist($username)){
                // return 'masupp';
                // return md5('aaaa');
                return $this->fcd->getSingleUserPassword($username, $pass);
            }
            else
            {
                return USER_TIDAK_DITEMUKAN;
            }
            return 'masuupp 2';

        }
        public function register($gender, $pass, $email, $name, $phone, $status){
            return $this->fcd->createUser($gender, $pass, $email, $name, $phone, $status);
        }

        
        
    }
?>