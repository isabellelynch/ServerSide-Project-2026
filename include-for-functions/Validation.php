<?php

function ValidName(string $name, string $n):string
{
    if($name === "")
    {
        return "Invalid! $n must be entered.";
    }
    else if(mb_strlen($name) < 2 || mb_strlen($name) > 30)
    {
        return "Invalid! Please ensure $n has between 2 and 30 characters.";
    }
    // letters (including accented letters such as á, é, í, ó, ú), spaces, apostrophes and dashes,
    // so names like Seán, Siobhán and O'Brien are accepted
    else if(!preg_match("/^[\p{L}\s'’-]+$/u", $name))
    {
        return "Invalid! $n must only contain letters, spaces, apostrophes and dashes.";
    }
    else
    {
        return "Valid";
    }
}

function ValidPhoneNumber(string $phone):string
{
    if($phone === "")
    {
        return "Invalid! Phone number must be entered.";
    }
    else if(!preg_match('/^[0-9\s()+-]+$/', $phone))
    {
        return "Invalid! Phone number can only contain digits, spaces, brackets, + and -.";
    }

    $clean = preg_replace('/\D/', '', $phone);

    if(strlen($clean) < 9 || strlen($clean) > 15)
    {
        return "Invalid! Phone number must contain between 9 and 15 digits.";
    }
    else if(strlen($phone) > 20)
    {
        return "Invalid! Phone number can be at most 20 characters long.";
    }
    else
    {
        return "Valid";
    }
}

function ValidEmail(string $email):string
{
    if(strlen($email) > 100)
    {
        return "Invalid! Email can be at most 100 characters long.";
    }
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

// at least 8 characters, with an uppercase letter, a lowercase letter, a number and a special character
function ValidatePassword($password){
    return strlen($password) >= 8 &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password) &&
           preg_match('/[\W_]/', $password);
}

?>
