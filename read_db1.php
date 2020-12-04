<!DOCTYPE html>
<html>
	<?php
		//Creates new record as per request
		//Connect to database
		$hostname = "localhost";		//example = localhost or 192.168.0.0
		$username = "root";		//example = root
		$password = "";	
		$dbname = "smartirrigation";
		// Create connection
		$conn = mysqli_connect($hostname, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed !!!");
		} 
	?>
	<body>
        <table class="table table-dark" >
            <tbody>
                <tr>
                    <th>id</th> 
                    <th>Soil Moisture Value</th> 
                    <th>Water Level</th> 
                    <th>Date</th>
                </tr>	
                <?php
                    $table = mysqli_query($conn, "SELECT id, Soil_Moisture_Val,waterlevel,Date FROM sensorlogs order by id DESC LIMIT 5 "); //nodemcu_ldr_table = Youre_table_name
                    while($row = mysqli_fetch_array($table))
                    {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["Soil_Moisture_Val"]; ?></td>
                    <td><?php echo $row["waterlevel"]; ?></td>
                    <td><?php echo $row["Date"]; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
	</body>
</html>