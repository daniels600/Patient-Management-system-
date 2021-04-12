<?php
    require_once "../config/db_conn.php";

    //creating an instance of db_connection 
	$db = new DB_connection();

    if(isset($_GET['id'])) {
        $sql = "SELECT imageType,image_data FROM patients WHERE patientid=" . $_GET['id'];

		// $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));

		//Executing the query
        $result = $db->connect()->query($sql);

		$row = $result->fetch_assoc();

		header("Content-type: " . $row["imageType"]);

		//$data = $result['image'];
        
		echo $result['image'];
	}
	mysqli_close($conn);
?>