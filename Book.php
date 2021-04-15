<?php
    require dirname(__FILE__).'/controller/BookController.php';
    $ctrl = new BookController();
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        echo json_encode($ctrl->getBook());
    }
?>