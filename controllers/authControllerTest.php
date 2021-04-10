<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Include config file
// include_once ("C:/xampp/htdocs/final-daniels600/config/db_conn.php");

include_once ('C:/xampp/htdocs/final-daniels600/controllers/authController.php');

final class authControllerTest extends TestCase
{
    public function testLogin(): void
    {
        $auth  = new authController();
        $credential = [
            'admin_email' => 'admin@gov.com',
            'admin_password'=>'password123'
        ];
        
        $this->assertTrue(
            $auth->Login($credential)
        );
    }

    
}