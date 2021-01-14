<?php
$conn = mysqli_connect("localhost", "root", "", "smartirrigation");
if(isset($_GET['dateVal']))
{
    $dateVal = $_GET['dateVal'];
//    $result = mysqli_query($conn, "SELECT id, Soil_Moisture_Val FROM sensorlogs where Date(Date) =(SELECT DISTINCT Date(Date) FROM `sensorlogs` order by Date(Date) DESC limit 1) order by id DESC ");
    $result = mysqli_query($conn, "SELECT time(Date) as time, Soil_Moisture_Val FROM sensorlogs where Date(Date) = Date('".$dateVal."')");
    $data = array();
    while ($row = mysqli_fetch_object($result))
    {
        array_push($data, $row);
    }

    echo json_encode($data);
    exit();
}

else{
    echo "no data";
}


?>