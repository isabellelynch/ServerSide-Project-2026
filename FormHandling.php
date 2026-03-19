<?php
require_once("DatabaseActions.php");
require_once('Validation.php');
require_once("MakeConnection.php");

$pdo = MakeConnection();
$errors = [];
$success = "";
 
$style = "none"; 

$firstName = $surname = $email = $phone = "";

if(isset($_POST['CloseForm']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
    $style = "none";
}

function AddStudent()
{
    if(isset($_POST['SubmitAddStudent']) && $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            global $pdo;
            
            $style = "block";
            
            $firstName = (isset($_POST['FirstName']))?htmlspecialchars(trim($_POST['FirstName'])):"";
            $surname = (isset($_POST['Surname']))?htmlspecialchars(trim($_POST['Surname'])):"";
            $email = (isset($_POST['Email']))?htmlspecialchars(trim($_POST['Email'])):"";
            $phone = (isset($_POST['PhoneNo']))?htmlspecialchars(trim($_POST['PhoneNo'])):"";
            
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
                
                 
                $firstName = $surname = $email = $phone = "";
                $errors = [];
                
            }
     
            
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


if(isset($_GET['Operation']))
{   
    $style = 'block';
    
    
    
    $operation =  $_GET['Operation'];
    
    if($operation === 'Update')
    {
        $id = trim($_GET['id']);

        if(Exists("Student", $id))
        {
            $sql = "SELECT * FROM Students WHERE StudentID = $id";
            $result = QueryDatabase($sql);
            $row = $result->fetch();
            $firstName = $row['FirstName'];
            $surname = $row['Surname'];
            $email = $row['Email'];
            $phone = $row['PhoneNo'];

        
        }
        
        
            
    
    }
    else if($operation === 'Add')
    {
        AddStudent();
    }
    if(isset($_POST['CloseForm']) && $_SERVER['REQUEST_METHOD'] === 'POST')
    {
        header("Location:Students.php");
        exit;
    }
    require_once("DisplayForm.php");
}




    
?>