<?php

    class UserController{

        public $fcd;
        function __construct(){
            require dirname(__FILE__).'/../facades/UserFacade.php';
            $this->fcd = new UserFacade();
        }

        public function getUser()
        {
            return $this->fcd->getUser();
        }
        
    }
?>