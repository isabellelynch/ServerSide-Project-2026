<?php
require_once("DatabaseActions.php");
require_once('Validation.php');
require_once("MakeConnection.php");

$pdo = MakeConnection();
$msg = "";
$showForm = false;
$student = [
    'name' => (isset($_POST['FirstName']))?trim($_POST['FirstName']):"",
    'surname' => (isset($_POST['Surname']))?trim($_POST['Surname']):"",
    'email' => (isset($_POST['Email']))?trim($_POST['Email']):"",
    'phone' => (isset($_POST['PhoneNo']))?trim($_POST['PhoneNo']):"",
    'id' => (isset($_POST['id']))?trim($_POST['id']):""
];

function AddStudent()
{
    global $pdo, $msg, $student;

    
    $stmt = $pdo->prepare("INSERT INTO Students 
                    (FirstName, Surname, Email, PhoneNo,Status) 
                    VALUES (:name, :surname, :email, :phone, 'A')");
                            
    $stmt->bindValue(':name', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  

    $stmt->execute();
    
    $msg = $student['name'] . " " .  $student['surname'] . "successfully added to the system.";

    $student = [];
}

function UpdateStudent(){
    global $pdo, $student;

    $stmt = $pdo->prepare("UPDATE Students SET 
                            FirstName = :firstname, 
                            Surname = :surname, 
                            Email = :email, 
                            PhoneNo = :phone 
                            WHERE StudentID = :id");

    $stmt->bindValue(':firstname', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  
    $stmt->bindValue(':id', $student['id']); 

    $stmt->execute();

    $student = [];
}

function PermanentlyRemoveStudent(){
    global $pdo, $student;

    $stmt = $pdo->prepare("DELETE FROM Students 
                           WHERE StudentID = :id");

    $stmt->bindValue(':id', $student['id']); 

    $stmt->execute();

    $student = [];
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

if (isset($_POST['UpdateStudentBtn'])){
    if(ValidateStudent() === ""){
        UpdateStudent();
    }
    else{
        $msg = ValidateStudent();
    }
    
} 

if (isset($_POST['PermanentRemoval'])){
    PermanentlyRemoveStudent();
} 

if (isset($_POST['AddStudentBtn'])){

    if(ValidateStudent() === ""){
        AddStudent();
        echo json_encode([
            "success" => true,
            "message" => "Student added successfully"
        ]);
    }
    else{
        $msg = ValidateStudent();
        echo json_encode([
            "success" => false,
            "message" => $msg
            ]);

    }
    exit;

} 

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['AddStudentBtn'])){
    if(ValidateStudent() === ""){
        AddStudent();
        echo json_encode([
            "success" => true,
            "message" => "Student added successfully"
        ]);
    }
    else{
        $msg = ValidateStudent();
        echo json_encode([
            "success" => false,
            "message" => $msg
            ]);

    }
    exit;
}

if(isset($_POST['CloseForm'])){
    $student = [];
}


function ValidateStudent():string{
    global $student;
    if(ValidName($student['name'], "First Name") !== "Valid")
    {
        return ValidName($student['name'], "First Name");
    }
    else if(ValidName($student['surname'], "Surname") !== "Valid")
    {
        return ValidName($student['surname'], "Surname");
    }
    else if(ValidEmail($student['email']) !== "Valid")
    {
        return ValidEmail($student['email']);
    }
    else if(ValidPhoneNumber($student['phone']) !== "Valid")
    {
        return ValidPhoneNumber($student['phone']);
    } 
    return "";
}
   
?>