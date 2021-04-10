<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Include config file
// include_once ("C:/xampp/htdocs/final-daniels600/config/db_conn.php");

include_once ('C:/xampp/htdocs/final-daniels600/controllers/prisonerController.php');


// All ids passed  must be set in the prisonerController class respective methods
final class prisonerControllerTest extends TestCase
{
   
    //Testing if Display prisoners return an array 
    public function testDisplay_All_Prisoners(): void
    {
        $prisoner = new Prisoner();        
        $this->assertIsArray(
            $prisoner->Display_All_Prisoners()
        );
    }

    //Testing if Display prisoners return an array 
    public function testDeletePrisoner(): void
    {
        $prisoner = new Prisoner();
        $id=2;        
        $this->assertTrue(
            $prisoner->deletePrisoner($id)
        );
    }

    //Testing if Display prisoners return an array 
    public function testDisplayPrisonerBio(): void
    {
        $prisoner = new Prisoner();
        $id=2;        
        $this->assertIsArray(
            $prisoner->DisplayPrisonerBio($id)
        );
    }

     //Testing if Display prisoners return an array 
     public function testgetPrisonerCase(): void
     {
         $prisoner = new Prisoner();
         $id=2;        
         $this->assertIsArray(
             $prisoner->getPrisonerCase($id)
         );
     }

      //Testing if get Officer Details return an array 
      public function testgetOfficerDetails(): void
      {
          $prisoner = new Prisoner();
          $id=2;        
          $this->assertIsArray(
              $prisoner->getOfficerDetails($id)
          );
      }

}

