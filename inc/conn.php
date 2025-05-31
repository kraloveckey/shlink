<?php
$conn = @mysqli_connect(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_passwd'],
    $config['mysql_db']
);

// Check connection
if (mysqli_connect_errno()){ // No argument here
    die("Failed to connect to database: " . mysqli_connect_error()); // No argument here
}
?>