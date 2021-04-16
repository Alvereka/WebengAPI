<?php
    require dirname(__FILE__).'/controller/BookController.php';
    $ctrl = new BookController();
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        // if(isset($_GET['action']) && $_GET['action']=='getbook'){            
            echo json_encode($ctrl->getBook());
        // }
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['action']) && $_POST['action']=='getsinglebook'){
            $author = $_REQUEST['author'];            
            $judul= $_REQUEST['judul'];            
            echo json_encode($ctrl->getSingleBook($judul, $author));
        }
        if(isset($_POST['action']) && $_POST['action']=='createBook'){
            $judul =$_REQUEST['judul'];
            $author =$_REQUEST['author'];
            $terbit =$_REQUEST['terbit'];
            $kategori =$_REQUEST['kategori'];
            $deskripsi =$_REQUEST['deskripsi'];
            $pdf =$_REQUEST['pdf'];
            $gambar =$_REQUEST['gambar '];
            
            echo json_encode($ctrl->createBook($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar));
        }
        if(isset($_POST['action']) && $_POST['action']=='deletebook'){
            $author = $_REQUEST['author'];            
            $judul= $_REQUEST['judul'];       
            echo json_encode($ctrl->deleteBook( $judul,$author));
        }
        if(isset($_POST['action']) && $_POST['action']=='updatebook'){
            $judul =$_REQUEST['judul'];
            $author =$_REQUEST['author'];
            $terbit =$_REQUEST['terbit'];
            $kategori =$_REQUEST['kategori'];
            $deskripsi =$_REQUEST['deskripsi'];
            $pdf =$_REQUEST['pdf'];
            $gambar =$_REQUEST['gambar '];
            
            echo json_encode($ctrl->updateUser($judul, $author, $terbit, $kategori, $deskripsi, $pdf,$gambar));
        }
    }

?>