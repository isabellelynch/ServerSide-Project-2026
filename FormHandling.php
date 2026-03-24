<?php
require_once("DatabaseActions.php");
require_once('Validation.php');
require_once("MakeConnection.php");

$pdo = MakeConnection();
$formTitle = $btnLabel = $msg = "";
$showModal = false;

function AddStudent()
{
    $firstName = (isset($_POST['FirstName']))?htmlspecialchars(trim($_POST['FirstName'])):"";
    $surname = (isset($_POST['Surname']))?htmlspecialchars(trim($_POST['Surname'])):"";
    $email = (isset($_POST['Email']))?htmlspecialchars(trim($_POST['Email'])):"";
    $phone = (isset($_POST['PhoneNo']))?htmlspecialchars(trim($_POST['PhoneNo'])):"";
    global $pdo, $msg;
    
    if(ValidName($firstName, "First Name") !== "Valid")
    {
        $msg = ValidName($firstName, "First Name");
        return;
    }
    else if(ValidName($surname, "Surname") !== "Valid")
    {
        $msg = ValidName($surname, "Surname");
        return;
    }
    else if(ValidEmail($email) !== "Valid")
    {
        $msg = ValidEmail($email);
        return;
    }
    else if(ValidPhoneNumber($phone) !== "Valid")
    {
        $msg = ValidPhoneNumber($phone);
        return;
    } 

    $stmt = $pdo->prepare("INSERT INTO Students 
                    (FirstName, Surname, Email, PhoneNo,Status) 
                    VALUES (:name, :surname, :email, :phone, 'A')");
                            
    $stmt->bindValue(':name', $firstName);
    $stmt->bindValue(':surname', $surname);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', $phone);  

    $stmt->execute();
    
    $msg = "$firstName $surname successfully added to the system.";

    
}

function UpdateStudent($id){
    global $pdo;

    $firstName = (isset($_POST['FirstName']))?htmlspecialchars(trim($_POST['FirstName'])):"";
    $surname = (isset($_POST['Surname']))?htmlspecialchars(trim($_POST['Surname'])):"";
    $email = (isset($_POST['Email']))?htmlspecialchars(trim($_POST['Email'])):"";
    $phone = (isset($_POST['PhoneNo']))?htmlspecialchars(trim($_POST['PhoneNo'])):"";

    $stmt = $pdo->prepare("UPDATE Students SET 
                            FirstName = :firstname, 
                            Surname = :surname, 
                            Email = :email, 
                            PhoneNo = :phone 
                            WHERE StudentID = :id");

    $stmt->execute([$firstName, $surname, $email, $phone, $id]);

    $msg = "Student sucessfully updated";
    $firstName = $surname = $phone = $email = "";

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

if (isset($_GET['action']) && $_GET['action'] === 'UpdateStudent'){
    $showModal = true;
    header("Location:Students.php");
} 


if(isset($_POST['StudentOperationButton'])) {
    echo "hello";
    
    $showModal = true;
}





    






    
?>