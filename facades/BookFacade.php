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
        $user = array();
        $i=0;
        while($data = $stmt->fetch()){
            $user[$i]['id'] = $id;
            $user[$i]['judul'] = $judul;
            $user[$i]['author'] = $author;
            $user[$i]['terbit'] = $terbit;
            $user[$i]['kategori'] = $kategori;
            $user[$i]['deskripsi'] = $deskripsi;
            $user[$i]['pdf'] = $pdf;
            $user[$i]['gambar'] = $gambar;
            
            $i++;
        }
        return $user;
    }
    


}

?>