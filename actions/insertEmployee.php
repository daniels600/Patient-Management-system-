<?php 

session_start();

require_once '../controllers/employeeController.php';

$employee = new Employee();

$response = array();

if(isset($_POST['submit'])) {
   //check if insertion is successful then redirect
   if($employee->insertEmployee($_POST)){
      header('Location: ../views/forms/employeeForm.php?message=success');
   }else{
      header('Location: ../views/forms/employeeForm.php?message=error');
   }
}