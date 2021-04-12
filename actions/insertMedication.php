<?php 
//Using sessions 
// session_start();

require_once '../controllers/patientController.php';

$patient = new Patient();

//an array to get the messages 
$response = array();

if(isset($_POST['submit'])) {

    //calling the insert prisoner function 
    if($patient->insert_medication($_POST)){
        header('Location: ../views/forms/medication.php?message=success');
    }else{
        
    }

}
