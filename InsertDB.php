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

    //Get current date and time

    if(!empty($_POST['soilmoisture']))
    {
		$sens = $_POST['soilmoisture'];
        $waterlevel = $_POST['waterlevel'];

	    $sql = "INSERT INTO sensorlogs ( Soil_Moisture_Val,waterlevel) VALUES ('".$sens."','".$waterlevel."')"; //nodemcu_ldr_table = Youre_table_name

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
        echo "no data";
    }


	$conn->close();
?>