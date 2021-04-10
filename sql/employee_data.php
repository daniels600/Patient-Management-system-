<?php
header('Content-Type: application/json');

// Include config file
include "../config/db_conn.php";



//creating an instance of db_connection 
$db = new DB_connection();


// A query to get the different sex and their respective population
$sql = "SELECT sex,COUNT(*) as count 
        FROM Employees 
        GROUP BY sex 
        ORDER BY count DESC";


//executing the query
$result = $db->connect()->query($sql);

$data = array();

// storing the record in an array
foreach ($result as $row) {
    $data[] = $row;
}


mysqli_close($db->connect());
  

echo json_encode($data);













?>

