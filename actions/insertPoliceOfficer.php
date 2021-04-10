<?php 

session_start();

require_once '../controllers/prisonerController.php';

//creating an instance of Prisoner
$prisoner = new Prisoner();

// an array to keep the messages
$response = array();

if(isset($_POST['submit'])) {
    
    
    $prisoner->insertPoliceOfficer($_POST);
}


















?>