<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Include config file
// include_once ("C:/xampp/htdocs/final-daniels600/config/db_conn.php");

include_once ('C:/xampp/htdocs/final-daniels600/controllers/employeeController.php');

final class employeeControllerTest extends TestCase
{
    //Testing if Insert Employee return true 
    public function testInsertEmployee(): void
    {
        $employee = new Employee();
        $credential = [];
        
        $this->assertTrue(
            $employee->insertEmployee($credential)
        );
    }

    //Testing ig Display Employees return an array 
    public function testDisplay_All_Employees(): void
    {
        $employee = new Employee();        
        $this->assertIsArray(
            $employee->Display_All_Employees()
        );
    }

    //Testing if Display Employee return an array
    public function testDisplayEmployee(): void
    {
        $employee = new Employee(); 
        $id=3;      
        $this->assertIsArray(
            $employee->DisplayEmployee($id)
        );
    }

    //Testing if delete employee works based on the id given 
    //And it returns a true on working or a false on not working
    public function testDeleteEmployee(): void
    {
        $employee = new Employee(); 
        $id=3;      
        $this->assertTrue(
            $employee->DeleteEmployee($id)
        );
    }

    //Testing if Update Employee return true 
    public function testUpdateEmployee(): void
    {
        $employee = new Employee();
        $credential = [];
        
        $this->assertTrue(
            $employee->UpdateEmployee($credential)
        );
    }

    
}