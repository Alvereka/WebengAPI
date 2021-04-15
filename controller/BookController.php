<?php

    class BookController{

        public $fcd;
        function __construct(){
            require dirname(__FILE__).'/../facades/BookFacade.php';
            $this->fcd = new BookFacade();
        }

        public function getBook()
        {
            return $this->fcd->getBook();
        }
        
    }
?>