<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";		//example = localhost or 192.168.0.0
    $username = "root";		//example = root
    $password = "";	
    $dbname = "smartirrigation";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }


    if(isset($_POST['soilmoisture']))
    {
		$sens = $_POST['soilmoisture'];
        $intensity = $_POST['intensity'];
        $operation = $_POST['operation'];
        $pump = $_POST['pump'];

	    $sql = "INSERT INTO sensorlogs ( Soil_Moisture_Val,intensity,operation,pump) VALUES ('".$sens."','".$intensity."','".$operation."','".$pump."')"; 

		if ($conn->query($sql) === TRUE) {
		    echo "nice";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
        echo "no data";
    }


	$conn->close();
?>