<?php
require_once("DatabaseActions.php");
require_once("Validation.php");

$msg = "";

$student = [
    'name' => (isset($_POST['FirstName']))?trim($_POST['FirstName']):"",
    'surname' => (isset($_POST['Surname']))?trim($_POST['Surname']):"",
    'email' => (isset($_POST['Email']))?trim($_POST['Email']):"",
    'phone' => (isset($_POST['PhoneNo']))?trim($_POST['PhoneNo']):"",
    'id' => (isset($_POST['id']))?trim($_POST['id']):""
];

//link in Students table to go from active to inactive
if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
{
    $id = $_GET['id'];
    try 
    {
        UpdateStatus("Student",$id); 
        header("Location:Students.php");
    }
    catch (PDOException $e) 
    { 
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['UpdateStudentBtn'])){
        $update = true;
        $add = false;
        $header = "Update Student Form";

        $msg = ValidateStudent($student);
        
        if($msg === ""){
            UpdateStudent($student);
        }   
    } 

    if (isset($_POST['PermanentRemoval'])){
        PermanentlyRemoveStudent($student);
    } 

    if(isset($_POST['AddStudentBtn'])){
        $update = false;
        $add = true;
        $header = "New Student Form";

        $msg = ValidateStudent($student);

        if($msg === ""){
            AddStudent($student);
        }
    }
    if(isset($_POST['CloseForm'])){
        $student = [];
    }
}






?>