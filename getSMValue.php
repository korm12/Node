
    
<?php
    //Creates new record as per request
    //Connect to database
    $hostname = "localhost";		//example = localhost or 192.168.0.0
    $username = "root";		//example = root
    $password = "";	
    $dbname = "smartirrigation";
    // Create connection
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed !!!");
    } 
    $sql ="SELECT Soil_Moisture_Val FROM sensorlogs order by id DESC LIMIT 1 "; $result = $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
     $soilmoisture = $row["Soil_Moisture_Val"];
    }
 
   echo $soilmoisture;
       ?>    
