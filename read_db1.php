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
                    <th>Operation</th> 
                    <th>Pump</th> 
                </tr>	
                <?php
                    $table = mysqli_query($conn, "SELECT operation,pump FROM sensorlogs order by id DESC LIMIT 1 "); //nodemcu_ldr_table = Youre_table_name
                    while($row = mysqli_fetch_array($table))
                    {
                ?>
                <tr>
                    <td><?php echo $row["operation"]; ?></td>
                    <td><?php echo $row["pump"]; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
	</body>
</html>