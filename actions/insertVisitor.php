<?php 

// session_start();

require_once '../controllers/visitorController.php';

$response = array();

 //creating an instance of visitor
 $visitor = new Visitor();

 
//checking for a post inputs here
if(isset($_POST['submit'])) {

    if($visitor->insertVisitor($_POST)){
         //redirecting admin if there is a successful insertion in DB
         header('Location: ../views/forms/visitorForm.php?message=success');
    } else {
        header('Location: ../views/forms/visitorForm.php?error=failed');
    }

    
}















?>