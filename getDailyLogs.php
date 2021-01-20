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
        <table class="table table-dark" cellpadding="3" style="border: 1px solid black; border-collapse: collapse; width:100%;">
            <tbody>
                <tr>
                    <th style="border: 1px solid black; border-collapse: collapse;">Soil Moisture</th> 
                    <th style="border: 1px solid black; border-collapse: collapse;">intensity</th>
                    <th style="border: 1px solid black; border-collapse: collapse;">Operation</th> 
                    <th style="border: 1px solid black; border-collapse: collapse;">Pump</th> 
                    <th style="border: 1px solid black; border-collapse: collapse;">Date</th> 
                </tr>	
                <?php
                    $table = mysqli_query($conn, "SELECT Soil_Moisture_Val, intensity, operation, pump, Date FROM sensorlogs where Date(Date) = Date('".$dateVal."')"); //nodemcu_ldr_table = Youre_table_name
                    while($row = mysqli_fetch_array($table))
                    {
                ?>
                <tr >
                    <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $row["Soil_Moisture_Val"]; ?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $row["intensity"]; ?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $row["operation"]; ?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $row["pump"]; ?></td>
                    <td style="border: 1px solid black; border-collapse: collapse;"><?php echo $row["Date"]; ?></td>
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