<?php

//initialize a session
session_start();

// Include config file
include "../config/db_conn.php";

class Employee {

    //Function to insert an employee details
    public function insertEmployee($post){
        //creating an instance of db_connection 
        $db = new DB_connection();

        $empFname = $db->connect()->real_escape_string($_POST['fname']);
        $empLname = $db->connect()->real_escape_string( $_POST['lname']);
        $nationality = $db->connect()->real_escape_string( $_POST['nationality']);
        $Dept = $db->connect()->real_escape_string($_POST['dept_name']);
        $salary = $db->connect()->real_escape_string( $_POST['salary']);
        $dob = $db->connect()->real_escape_string($_POST['dob']);
        $sex = $db->connect()->real_escape_string( $_POST['sex']);
        $marital_status = $db->connect()->real_escape_string($_POST['marital_status']);
        $edu = $db->connect()->real_escape_string($_POST['edu']);
        $ssn = $db->connect()->real_escape_string($_POST['ssn']);
        $telephone = $db->connect()->real_escape_string($_POST['telephone']);
        $email = $db->connect()->real_escape_string( $_POST['email']);
        $role = $db->connect()->real_escape_string( $_POST['role']);
        $streetAddress = $db->connect()->real_escape_string( $_POST['streetAddress']);
        $city = $db->connect()->real_escape_string( $_POST['city']);
        $state = $db->connect()->real_escape_string( $_POST['state']);
        $postcode = $db->connect()->real_escape_string($_POST['postcode']);
        $DOC = $db->connect()->real_escape_string($_POST['DOC']);

        //Uncomment Employee Data For PHPUnit Testing
        // $empFname = 'Elvin';
        // $empLname = 'Daniels';
        // $nationality = 'Ghanaian';
        // $prison = 'Tamale';
        // $Dept = 'Human Resource';
        // $salary = 234;
        // $dob = '2020-12-07';
        // $sex = 'Male';
        // $marital_status = 'Single';
        // $edu = 'Senior Secondary School';
        // $ssn = '123-45-5667';
        // $telephone = '0293092343';
        // $email = 'danielselvin71@gmail.com';
        // $role = 'Officer';
        // $streetAddress = 'Ajakroba st.';
        // $city = 'Accra';
        // $state = 'Greater Accra';
        // $postcode = 'P.o.Box NT 9023';
        // $DOC = '2020-08-07';
        
        // a query to insert a new employee record
        $sql = "INSERT INTO Employees(Employee_fname,Employee_lname,Dept_name,nationality,work_commence_date,email,emp_tel,Job, sex,Marital_Status,level_of_education,Salary,DOB,SSN,address_street,address_city,address_region,address_postal_code)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        //Checking with Regex if input doesn't have a match 
        if(!preg_match("/^[a-zA-Z ]*$/",  $empFname) && !preg_match("/^[a-zA-Z ]*$/", $empLname) && !preg_match("/^[a-zA-Z ]*$/", $nationality) && !preg_match("/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/", $telephone) && !preg_match("/^[a-zA-Z ]*$/", $role) && !preg_match("/^[a-zA-Z ]*$/", $edu) && !preg_match("/^[a-zA-Z ]*$/", $marital_status) && !preg_match("/^[ A-Za-z0-9 _.,\/+-]*$/", $postcode)){
            $response['message'] = "Failed";
            return false;
        }else{
            $stmt =  $db->connect()->prepare($sql);

            $stmt->bind_param('sssssssssssdssssss', $empFname ,$empLname,$Dept,$nationality,$DOC,$email,$telephone,$role,$sex,$marital_status,$edu,$salary,$dob,$ssn,$streetAddress,$city,$state, $postcode);

                if($stmt->execute()){
                    $response['message'] = "Success";
                    return true;

                } else {
                    $response['message'] = "Failed";
                    return false;
                }
                //close statement
                $stmt->close();
            }

        }



        public function Display_All_Employees(){
             //creating an instance of db_connection 
            $db = new DB_connection();

            //a query to select all employees data from the DB
            $sql = "SELECT 
            Employees.Employee_ID,
            Employees.Employee_fname,
            Employees.Employee_lname,
            Employees.salary,
            Employees.SSN,
            Employees.Job,
            Employees.work_commence_date
            FROM
            Employees";

             //executing the query
            $result = $db->connect()->query($sql);

            //Checking if rows have been affected 
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {

                    //Saving data in an associative array
                    $data[] = $row;
                }

                //returning the data
                return $data;

                }else{
                echo "No found records";
                }

        }



        public function DisplayEmployee($id){
            //creating an instance of db_connection 
            $db = new DB_connection();

            //Depending on the id in the Database if id = 3 is in the database it will return a true 
            //Else a false on testing
            //$id=7;


             //query the record of an employee with this id
            $sql = "SELECT * FROM Employees WHERE Employee_ID = '$id'";

            $result =  $db->connect()->query($sql);
            

                //checking if the query affected any row then is a success
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row;

                }else{
                    echo "Record not found";
                }
           
        }

        //A function to delete a specific visitor data from the DB
        public function DeleteEmployee($id){
            //creating an instance of db_connection 
            $db = new DB_connection();

            //Depending on the id in the Database if 4 is in the database it will return a true 
            //Else a false on testing
            //$id = 6;

            //a query to delete the employee record with this id
            $sql = "DELETE FROM Employees where Employee_ID='$id'";

            $result = mysqli_query($db->connect(),$sql);

            //checking if the query was successful and redirecting to the visitor page
            if($result){
                return true;
            }else{
                return false;
            }
        }


        public function UpdateEmployee($employeeData){
             //creating an instance of db_connection 
             $db = new DB_connection();

             $id = $db->connect()->real_escape_string($_POST['employee_id']);
             $empFname = $db->connect()->real_escape_string($_POST['fname']);
             $empLname = $db->connect()->real_escape_string($_POST['lname']);
             $nationality = $db->connect()->real_escape_string($_POST['nationality']);
             $Dept = $db->connect()->real_escape_string($_POST['dept_name']);
             $salary = $db->connect()->real_escape_string($_POST['salary']);
             $dob = $db->connect()->real_escape_string($_POST['dob']);
             $sex = $db->connect()->real_escape_string($_POST['sex']);
             $marital_status = $db->connect()->real_escape_string($_POST['marital_status']);
             $edu = $db->connect()->real_escape_string($_POST['edu']);
             $ssn = $db->connect()->real_escape_string($_POST['ssn']);
             $telephone = $db->connect()->real_escape_string($_POST['telephone']);
             $email = $db->connect()->real_escape_string($_POST['email']);
             $role = $db->connect()->real_escape_string($_POST['role']);
             $streetAddress = $db->connect()->real_escape_string($_POST['streetAddress']);
             $city = $db->connect()->real_escape_string($_POST['city']);
             $state = $db->connect()->real_escape_string($_POST['state']);
             $postcode =$db->connect()->real_escape_string($_POST['postcode']);
             $DOC = $db->connect()->real_escape_string($_POST['DOC']);
            
             //Uncomment Employee Data For PHPUnit Testing of Update 
             //Changed the First and Last name
                // $empFname = 'Eugene';
                // $empLname = 'Atoh';
                // $nationality = 'Ghanaian';
                // $prison = 'Tamale';
                // $Dept = 'Human Resource';
                // $salary = 234;
                // $dob = '2020-12-07';
                // $sex = 'Male';
                // $marital_status = 'Single';
                // $edu = 'Senior Secondary School';
                // $ssn = '123-45-5667';
                // $telephone = '0293092343';
                // $email = 'danielselvin71@gmail.com';
                // $role = 'Officer';
                // $streetAddress = 'Ajakroba st.';
                // $city = 'Accra';
                // $state = 'Greater Accra';
                // $postcode = 'P.o.Box NT 9023';
                // $DOC = '2020-08-07';
                
                // $id = 3;
             //Checking with Regex if input doesn't have a match 
           
            //executing the query to update the employee record
            $result = $db->connect()->query("UPDATE Employees SET Employee_fname='$empFname', Employee_lname='$empLname', Dept_name='$Dept', nationality='$nationality', work_commence_date='$DOC', email='$email', emp_tel='$telephone', Job='$role', sex='$sex', Marital_Status='$marital_status', level_of_education='$edu', Salary='$salary', DOB='$dob',SSN='$ssn',address_street='$streetAddress ',address_city='$city', address_region='$state',address_postal_code='$postcode' WHERE Employee_ID='$id'");
            
            if (isset($result)){
                return true;
                
            }else{
            return false;
            }
            
        }


}