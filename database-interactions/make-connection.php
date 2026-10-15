<?php
// Database settings - change these to match your own MySQL / MariaDB server.
// The defaults suit a standard XAMPP install (user "root" with no password).
const DB_HOST = 'localhost';
const DB_NAME = 'grindbookingsys';
const DB_USER = 'root';
const DB_PASS = '';

function MakeConnection():PDO
{
    try
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e)
    {
        // without a database nothing else can work, so stop here with a clear message
        http_response_code(500);
        exit("<h2>Unable to connect to the database server</h2>" .
             "<p>" . htmlspecialchars($e->getMessage()) . "</p>" .
             "<p>Check that MySQL is running and that the <strong>" . DB_NAME . "</strong> database has been created " .
             "by importing <code>database/grindbookingsys.sql</code>. Connection settings are at the top of " .
             "<code>database-interactions/make-connection.php</code>.</p>");
    }
}

if (!isset($pdo)) {
    $pdo = MakeConnection();
}

?>
