<?php

$hostname = "localhost";		
$username = "root";		
$password = "";	
$dbname = "smartirrigation";
// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed !!!");
} 

$date = mysqli_query($conn, "SELECT DISTINCT Date(Date) FROM sensorlogs order by Date DESC limit 1"); 
$data = array();
while($row = mysqli_fetch_array($date))
{   
    array_push($data, $row[0]);
}
echo json_encode($data);
    exit();
?>
