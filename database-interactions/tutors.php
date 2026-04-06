<?php
require_once(ROOT . "/database-interactions/general.php");

global $pdo;


if($_SERVER['REQUEST_METHOD']==="GET" && isset($_GET['id'])):
    $subjects = 
    foreach($subjects as $s): ?>
            <option>
                <?php echo $s; ?>
            </option>
<?php 
    endforeach;
endif;
?>

<?php
function GetAllTutorNames(){
    $sql = "SELECT TutorID, FirstName, Surname 
            FROM Tutors 
            WHERE Status = 'A'";

    $result = QueryDatabase($sql);

    return $result->fetchAll(PDO::FETCH_ASSOC);
}


function GetTutorRate($r){
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT HourlyRate 
                           FROM TutorRates 
                           WHERE RateCode = :r");
    $stmt->bindValue(':r', $r); 

    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['HourlyRate'];
}

function ensureTutorTeachesSubject($t, $s){
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) AS Count 
                            FROM TutorSubjects 
                            WHERE TutorID = :tid AND
                            SubjectCode = :scode");
    
    $stmt -> bindValue(":tid", $t);
    $stmt -> bindValue(":scode", $s);

    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['Count'];
}

?>