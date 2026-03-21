<?php
function MakeConnection()
{
    try
    {
        $pdo = new PDO('mysql:host=localhost;dbname=grindbookingsys;charset=utf8','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e)
    {
        $output = "Unable to connect to the database server : " . $e->getMessage();
        echo $output;
    }
}


?>
<?php
function MakeConnection()
{
    try
    {
        $pdo = new PDO('mysql:host=localhost;dbname=grindbookingsys;charset=utf8','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e)
    {
        $output = "Unable to connect to the database server : " . $e->getMessage();
        echo $output;
    }
}


?>