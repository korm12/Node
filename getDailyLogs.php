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
        if(isset($_GET['dateVal']))
        {
             $dateVal = $_GET['dateVal'];
	?>
	<body>
        <table class="table table-dark" >
            <tbody>
                <tr>
                    <th>Soil Moisture</th> 
                    <th>intensity</th>
                    <th>Operation</th> 
                    <th>Pump</th> 
                    <th>Date</th> 
                </tr>	
                <?php
                    $table = mysqli_query($conn, "SELECT Soil_Moisture_Val, intensity, operation, pump, Date FROM sensorlogs where Date(Date) = Date('".$dateVal."')"); //nodemcu_ldr_table = Youre_table_name
                    while($row = mysqli_fetch_array($table))
                    {
                ?>
                <tr><td><?php echo $row["Soil_Moisture_Val"]; ?></td>
                    <td><?php echo $row["intensity"]; ?></td>
                    <td><?php echo $row["operation"]; ?></td>
                    <td><?php echo $row["pump"]; ?></td>
                    <td><?php echo $row["Date"]; ?></td>
                </tr>
        <?php
                    }
        }

        else{
            echo "no data";
        }
        ?>
            </tbody>
        </table>
	</body>
</html>