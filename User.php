<?php
    require dirname(__FILE__).'/controller/UserController.php';
    $ctrl = new UserController();
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        // if(isset($_GET['action']) && $_GET['action']=='getuser'){            
            echo json_encode($ctrl->getUser());
        // }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['action']) && $_POST['action']=='getsingleuser'){
            $username = $_REQUEST['username'];            
            $email = $_REQUEST['email'];            
            echo json_encode($ctrl->getSingleUser($email, $username));
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['action']) && $_POST['action']=='createuser'){
            $gender = $_REQUEST['gender'];
            $pass   = $_REQUEST['pass'];
            $email  = $_REQUEST['email'];
            $name   = $_REQUEST['name'];
            $phone  = $_REQUEST['phone'];
            $status = $_REQUEST['status'];
            
            echo json_encode($ctrl->createUser($gender, $pass, $email, $name, $phone, $status));
        }
        if(isset($_POST['action']) && $_POST['action']=='deleteuser'){
            $email  = $_REQUEST['$email'];
            $name   = $_REQUEST['$name'];    
            echo json_encode($ctrl->deleteUser( $email, $name));
        }
        if(isset($_POST['action']) && $_POST['action']=='updateuser'){
            $gender = $_REQUEST['gender'];
            $pass   = $_REQUEST['pass'];
            $email  = $_REQUEST['email'];
            $name   = $_REQUEST['name'];
            $phone  = $_REQUEST['phone'];
            $status = $_REQUEST['status'];
            
            echo json_encode($ctrl->updateUser($gender, $pass, $email, $name, $phone, $status));
        }
        if(isset($_POST['action']) && $_POST['action']=='login'){
            
            $pass   = $_REQUEST['pass'];
            $username   = $_REQUEST['username'];
            
            echo json_encode($ctrl->login($username,$pass));
        }
        if(isset($_POST['action']) && $_POST['action']=='register'){
            $gender = $_REQUEST['gender'];
            $pass   = $_REQUEST['pass'];
            $email  = $_REQUEST['email'];
            $name   = $_REQUEST['name'];
            $phone  = $_REQUEST['phone'];
            $status = $_REQUEST['status'];
            
            echo json_encode($ctrl->register($gender, $pass, $email, $name, $phone, $status));
        }
    }
    
?>