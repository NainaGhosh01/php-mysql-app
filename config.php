<?php
// Database Configuration
define('DB_HOST', 'secure-database-1.cluster-ch0884o2o8rn.us-east-1.rds.amazonaws.com');
define('DB_USER', 'admin');
define('DB_PASS', 'Ng21-01-2003');
define('DB_NAME', 'myappdb');

// Connect to MySQL
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connect to Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Test Redis connection
if (!$redis->ping()) {
    die("Redis connection failed!");
}

// Example: Check if user list is cached
$cacheKey = "user_list";
$userList = $redis->get($cacheKey);

if (!$userList) {
    // Fetch from MySQL if not cached
    $result = $conn->query("SELECT * FROM users");
    $userList = json_encode($result->fetch_all(MYSQLI_ASSOC));

    // Store result in Redis cache for 5 minutes (300 seconds)
    $redis->set($cacheKey, $userList);
    $redis->expire($cacheKey, 300);
} else {
    $userList = json_decode($userList, true); // Convert back to array
}

// Now, $userList contains the user data (either from cache or database)
?>

