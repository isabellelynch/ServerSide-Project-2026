<?php
require_once("DatabaseActions.php");
require_once('Validation.php');
require_once("MakeConnection.php");

$pdo = MakeConnection();

$errors = [];
$success = "";

$firstName = (isset($_POST['FirstName']))?htmlspecialchars(trim($_POST['FirstName'])):"";
$surname = (isset($_POST['Surname']))?htmlspecialchars(trim($_POST['Surname'])):"";
$email = (isset($_POST['Email']))?htmlspecialchars(trim($_POST['Email'])):"";
$phone = (isset($_POST['PhoneNo']))?htmlspecialchars(trim($_POST['PhoneNo'])):"";

function AddStudent()
{
    global $pdo, $firstName, $surname, $email, $phone, $success, $errors;

    if(ValidName($firstName, "First Name") !== "Valid")
    {
        $errors[] = ValidName($firstName, "First Name");
    }
    else if(ValidName($surname, "Surname") !== "Valid")
    {
        $errors[] = ValidName($surname, "Surname");
    }
    else if(ValidEmail($email) !== "Valid")
    {
        $errors[] = ValidEmail($email);
    }
    else if(ValidPhoneNumber($phone) !== "Valid")
    {
        $errors[] = ValidPhoneNumber($phone);
    } 
    else if(empty($errors))
    {
        $stmt = $pdo->prepare("INSERT INTO Students 
                        (FirstName, Surname, Email, PhoneNo,Status) 
                        VALUES (:name, :surname, :email, :phone, 'A')");
                                
        $stmt->bindValue(':name', $firstName);
        $stmt->bindValue(':surname', $surname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);  
    
        $stmt->execute();
        
        $success = "$firstName $surname successfully added to the system.";
    }     
}

function UpdateStudent($id){
    global $firstName, $surname, $email, $phone;
    if(Exists("Student", $id)){
        echo "Hello";
    }
}



    
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

if(isset($_POST['StudentOperationButton'])) {
    if($_POST['StudentOperationButton'] === 'Add Student'){
        AddStudent();
    }
    else if($_POST['StudentOperationButton'] === 'Update Student' && isset($_POST['StudentID'])){
        $id = $_POST['StudentID'];
        UpdateStudent($id);
    }
}
if(isset($_POST['CloseForm']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
    header("Location:Students.php");
    exit;
}



    






    
?>