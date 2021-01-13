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
     
          <label for="date">Select Date:</label>
           <select id="date" class="date" name="date"">
        <?php
            $table = mysqli_query($conn, "SELECT DISTINCT Date(Date) FROM sensorlogs order by Date DESC"); //nodemcu_ldr_table = Youre_table_name
            while($row = mysqli_fetch_array($table))
            {
        ?>
            <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
        <?php
            }
        ?>
          </select>
        
	</body>
</html>