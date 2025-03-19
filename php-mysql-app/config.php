<?php
// config.php - Database Configuration
define('DB_HOST', 'secure-database-1.cluster-ch0884o2o8rn.us-east-1.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'Ng21-01-2003');
define('DB_NAME', 'secure-database-1');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>