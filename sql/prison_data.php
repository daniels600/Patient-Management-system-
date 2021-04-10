<?php
header('Content-Type: application/json');

// Include config file
include "../config/db_conn.php";



//creating an instance of db_connection 
$db = new DB_connection();


//a query to get the different prisons and their respective population
$sql = "SELECT Prison_name,COUNT(*) as count 
FROM Prisoner 
GROUP BY Prison_name 
ORDER BY count DESC";


//executing the query
$result = $db->connect()->query($sql);

//an array to keep the return of the query
$data = array();

//saving the  record in the data array
foreach ($result as $row) {
    $data[] = $row;
}


mysqli_close($db->connect());
  
// getting back the data in a json format 
echo json_encode($data);













?>

