<?php
$conn = mysqli_connect("localhost", "root", "", "smartirrigation");
if(isset($_GET['dateVal']))
{
    $dateVal = $_GET['dateVal'];
    $result = mysqli_query($conn, "SELECT time(Date) as time, pump FROM sensorlogs where Date(Date) = Date('".$dateVal."') ");
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