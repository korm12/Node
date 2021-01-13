<?php
$conn = mysqli_connect("localhost", "root", "", "smartirrigation");
$result = mysqli_query($conn, "SELECT id, Soil_Moisture_Val FROM sensorlogs  order by id DESC limit 50");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
exit();
?>