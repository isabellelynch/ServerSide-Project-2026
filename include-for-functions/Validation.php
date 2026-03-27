<?php

function ValidName(string $name, string $n):string
{
    if(strlen($name) < 2 || strlen($name) > 30)
    {
        return "Invalid! Please ensure $n has between 2 and 30 characters.";
    }
    else if(!preg_match('/^[a-zA-Z\s-]+$/', $name))
    {
        return "Invalid! $n must only contain letters, spaces and dashes.";
    }
    else if($name === null || $name === "")
    {
        return "Invalid! $n must be entered.";
    }
    else
    {
        return "Valid";
    }
}

function ValidPhoneNumber(string $phone):string
{
    if(strlen($phone) < 10 || strlen($phone) > 15)
    {
        return "Invalid! Phone number must be between 10 and 15 characters.";
    }
    else if($phone === null || $phone === "")
    {
        return "Invalid! Phone number must be entered.";
    }
    
    $clean = preg_replace('/\D/', '', $phone);
    
    if(strlen($clean) < 10 && strlen($clean) > 15)
    {
        return "Invalid! Too many digits";
    }
    else
    {
        return "Valid";
    }
}

function ValidEmail(string $email):string
{
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    return ($email === false)?"Invalid! Valid email must be entered.":"Valid";
}

function ValidateStudent($student):string{
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
