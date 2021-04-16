<?php

class BookFacade{

    private $conn;
    function __construct(){
        require dirname(__FILE__)."/../connection.php";

        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function getBook()
    {
        $stmt = $this->conn->prepare("SELECT * FROM books");
        $stmt->execute();
        // URUT YA BOSKUUUU
        $stmt->bind_result($id, $judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar);
        $book = array();
        $i=0;
        while($data = $stmt->fetch()){
            $book[$i]['id'] = $id;
            $book[$i]['judul'] = $judul;
            $book[$i]['author'] = $author;
            $book[$i]['tgl_terbit'] = $terbit;
            $book[$i]['kategori'] = $kategori;
            $book[$i]['deskripsi'] = $deskripsi;
            $book[$i]['pdf'] = $pdf;
            $book[$i]['gambar'] = $gambar;
            
            $i++;
        }
        return $book;
    }
    private function isBookExist($judul, $author)
    {
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE judul = ? OR author = ? ");
        $stmt->bind_param("ss", $judul, $author);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0; // tidak ada = true
    }
    public function createBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar)
    {
        if ($this->isBookExist($judul,$author)) {
            
            $stmt = $this->conn->prepare("INSERT INTO books (judul, author, tgl_terbit, kategori, deskripsi, pdf, gambar) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar);
            if ($stmt->execute()) {
                return BOOK_CREATED;
            } else {
                return BOOK_NOT_CREATED;
            }
        } else {
            return BOOK_ALREADY_EXIST;
        }
    }

    public function updateBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar)
    {
        if (!$this->isBookExist($judul, $author)) {
            
            $stmt = $this->conn->prepare("UPDATE books SET tgl_terbit=?, kategori=?, deskripsi=?, pdf=?, gambar=? WHERE judul=? OR author=? ");
            $stmt->bind_param("sssssss", $terbit, $kategori, $deskripsi, $pdf,$gambar,$judul, $author);
            if ($stmt->execute()) {
                return BOOK_UPDATED;
            } else {
                return BOOK_NOT_UPDATED;
            }
        } else {
            return BOOK_TIDAK_DITEMUKAN;
        }
    }
    public function getSingleBook($judul, $author){
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE judul=? AND  author = ?");
        $stmt ->bind_param('ss', $judul,$author);
        $stmt->execute();
        // URUT YA BOSKUUUU
        $stmt->bind_result($id, $judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar);

        $book = array();
        $i=0;
        while($data = $stmt->fetch()){
            $book[$i]['id'] = $id;
            $book[$i]['judul'] = $judul;
            $book[$i]['author'] = $author;
            $book[$i]['terbit'] = $terbit;
            $book[$i]['kategori'] = $kategori;
            $book[$i]['deskripsi'] = $deskripsi;
            $book[$i]['pdf'] = $pdf;
            $book[$i]['gambar'] = $gambar;
            
            $i++;
        }
        return $book;
    }
    
    public function deleteBook($judul, $author)
    {
        if (!$this->isBookExist($judul, $author)) {
            
            $stmt = $this->conn->prepare("DELETE FROM books WHERE judul=? OR author=?");
            $stmt->bind_param("ss", $judul, $author);
            if ($stmt->execute()) {
                return BOOK_DELETED;
            } else {
                return BOOK_NOT_DELETED;
            }
        } else {
            return BOOK_TIDAK_DITEMUKAN;
        }
    }


}

?>