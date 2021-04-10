<?php 

require_once '../controllers/visitorController.php';


$visitor = new Visitor();

//checking there is an id in the url
if(isset($_GET['id'])){
    $visitorID = $_GET['id'];

    // checking if delete is true and redirecting to the visitor page
    if($visitor->DeleteVisitor($visitorID)){
        header('Location: ../views/visitor.php?message=success');
    }else {
        header('Location: ../views/visitor.php?error=failed');
    }
}







