<?php
require_once(ROOT . "/database-interactions/rooms.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['previous-room'])){
        $_SESSION['room']--;
        if($_SESSION['room'] <= 0){
            $_SESSION['room'] = RoomCount();
        }  
    }
    if(isset($_POST['next-room'])){
        $_SESSION['room']++;
        if($_SESSION['room'] > RoomCount()){
            $_SESSION['room'] = 1;
        }
    }
}
?>