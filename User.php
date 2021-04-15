<?php
    require dirname(__FILE__).'/controller/UserController.php';
    $ctrl = new UserController();
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        echo json_encode($ctrl->getUser());
    }
?>