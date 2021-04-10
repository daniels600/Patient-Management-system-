<?php
header('Content-Type: application/json');
// Include config file
include "../config/db_conn.php";



//creating an instance of db_connection 
$db = new DB_connection();


// a query to get the different sex and their population 
$sql = "SELECT Sex,COUNT(*) as count 
FROM Prisoner 
GROUP BY Sex 
ORDER BY count DESC";


$result = $db->connect()->query($sql);

$data2 = array();


//saving the record in an array
foreach ($result as $row) {
    $data2[] = $row;
}


mysqli_close($db->connect());
  
// getting the array in a json format
echo json_encode($data2);













?>

