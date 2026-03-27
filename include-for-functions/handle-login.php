<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['login-btn'])){
            if(ValidLogin()){
                header("Location:Dashboard.php");
                exit;
            }
        }

    function ValidLogin(){
        return true;
    }

?>