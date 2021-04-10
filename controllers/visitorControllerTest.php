<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Include config file
// include_once ("C:/xampp/htdocs/final-daniels600/config/db_conn.php");

include_once ('C:/xampp/htdocs/final-daniels600/controllers/visitorController.php');

final class visitorControllerTest extends TestCase
{
    //Testing if Insert Visitor return true 
    public function testInsertVisitor(): void
    {
        $visitor = new Visitor();
        $credential = [];
        
        $this->assertTrue(
            $visitor->insertVisitor($credential)
        );
    }

    //Testing if Display visitors return an array 
    public function testDisplay_All_Visitors(): void
    {
        $visitor = new Visitor();        
        $this->assertIsArray(
            $visitor->Display_All_Visitors()
        );
    }

    //Testing if Display visitor return an array
    public function testDisplayVisitor(): void
    {
        $visitor = new Visitor(); 
        $id=3;      
        $this->assertIsArray(
            $visitor->DisplayVisitor($id)
        );
    }

    //Testing if delete employee works based on the id given 
    //And it returns a true on working or a false on not working
    public function testDeleteVisitor(): void
    {
        $visitor = new Visitor(); 
        $id=3;      
        $this->assertTrue(
            $visitor->DeleteVisitor($id)
        );
    }

    //Testing if Update Employee return true 
    public function testUpdateVisitorData(): void
    {
        $visitor = new Visitor();
        $credential = [];
        
        $this->assertTrue(
            $visitor->UpdateVisitorData($credential)
        );
    }

}