<?php
require_once(ROOT . "/database-interactions/subjects.php");
require_once(ROOT . "/database-interactions/general.php");

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['save-btn'])){
    $activeForm = $_POST['activeForm'] ?? "";

    // add a new subject
    if($activeForm === "new-subject"){
        $code = strtoupper(trim($_POST['subject-code'] ?? ""));
        $description = trim($_POST['subject-description'] ?? "");

        if($code === "" || $description === ""){
            errorHandler("Subject code and description must both be entered.");
        }
        if(!preg_match('/^[A-Z]{3}$/', $code)){
            errorHandler("Subject code must be exactly 3 letters, eg. MAT.");
        }
        if(mb_strlen($description) < 2 || mb_strlen($description) > 30 || !preg_match("/^[\p{L}\s'&-]+$/u", $description)){
            errorHandler("Description must be 2-30 characters and contain only letters, spaces, & and dashes.");
        }
        if(doesSubjectExist($code)){
            errorHandler("A subject with the code $code already exists.");
        }
        if(doesSubjectNameExist($description)){
            errorHandler("The subject $description already exists.");
        }

        addSubject($code, $description);
        successMsg("$description ($code) has been added.");
    }

    // remove a subject (only if no tutors teach it)
    if($activeForm === "delete"){
        $code = strtoupper(trim($_POST['remove-id'] ?? ""));

        if(!doesSubjectExist($code)){
            errorHandler("Subject could not be found, please try again.");
        }
        $tutors = subjectTutorCount($code);
        if($tutors > 0){
            errorHandler("This subject can't be removed because $tutors tutor" . ($tutors === 1 ? " teaches" : "s teach") . " it.");
        }

        removeSubject($code);
        successMsg("Subject has been removed.");
    }
}
?>
