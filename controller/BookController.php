<?php

    class BookController{

        public $fcd;
        function __construct(){
            require dirname(__FILE__).'/../facades/BookFacade.php';
            require dirname(__FILE__).'/../Constants.php';
            $this->fcd = new BookFacade();
        }

        public function getBook()
        {
            return $this->fcd->getBook();
        }
        public function createBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar)
        {
            return $this->fcd->createBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar);
        }
        public function updateBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar)
        {
            return $this->fcd->updateBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar);
        }
        public function deleteBook($judul,$author)
        {
            return $this->fcd->deleteBook($judul,$author);
        }
        public function getSingleBook($judul,$author)
        {
            return $this->fcd->getSingleBook($judul,$author);
        }
        public function getBookbyCategory($category)
        {
            return $this->fcd->getBookbyCategory($category);
        
        }
        public function cari($judul)
        {
            return $this->fcd->cari($judul);
        }
    }
?>