<?php


// Include config file
include "../config/db_conn.php";


class Patient
{
    //Creating properties
    private $patientID;

    // PrisonerID getter function
    public function getPrisonerID()
    {
        return $this->patientID;
    }

    //PrisonerID setter function
    public function setPatientID($patientID)
    {
        $this->patientID;
    }


    //A method to insert prisoner details 
    public function insert_patient($post)
    {
        session_start();

        //creating an instance of db_connection 
        $db = new DB_connection();

        $tm = md5(time()); //Hashing to make an image unique

        //Getting all the post or submitted input values
        $patientFname = $db->connect()->real_escape_string($_POST['pFname']);
        $patientLname = $db->connect()->real_escape_string($_POST['pLname']);
        $nationality = $db->connect()->real_escape_string($_POST['nationality']);
        $height = $db->connect()->real_escape_string($_POST['height']);
        $weight = $db->connect()->real_escape_string($_POST['weight']);
        $dob = $db->connect()->real_escape_string($_POST['dob']);
        $sex = $db->connect()->real_escape_string($_POST['gender']);
        $marital_status = $db->connect()->real_escape_string($_POST['marital_status']);
        $telephone = $db->connect()->real_escape_string($_POST['telephone']);
        $streetAddr = $db->connect()->real_escape_string($_POST['streetAddr']);
        $city = $db->connect()->real_escape_string($_POST['city']);
        $state = $db->connect()->real_escape_string($_POST['state']);
        $PostalCode = $db->connect()->real_escape_string($_POST['PostalCode']);
        $bloodType = $db->connect()->real_escape_string($_POST['bloodType']);
        $BMI = $db->connect()->real_escape_string($_POST['BMI']);
        $healthID = $db->connect()->real_escape_string($_POST['healthID']);
 
        $image_name = $_FILES['image']['name'];
        $dst = "../patientImages/" . $tm . $image_name;
        $dst1 = "patientImages/" . $tm . $image_name;
        $image_type = $_FILES['image']['type']; // getting the type to check if it is an image
        
        //$otp = rand(100000, 999999);

        // checking file upload if it is an image
        if (
            !empty($_FILES['image']['tmp_name'])
            && file_exists($_FILES['image']['tmp_name'])
        ) {
            $data = addslashes(file_get_contents($_FILES['image']['tmp_name']));

            $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");

            if (!in_array($image_type, $allowed)) {
                //$error_message = 'Only jpg, gif, and png files are allowed.';
                header("Location: ../views/forms/patientForm.php?error=wrongImage");
                exit();
            } else {
                move_uploaded_file($_FILES['image']['tmp_name'], $dst);
            }
        }

       
        //A query to insert a new prisoner
        $sql = "INSERT INTO patients(firstname, lastname, Height, Weight, Marital_Status, Nationality, Sex, DOB, patient_tel, healthID, BMI, bloodtype, address_street, address_city, address_region, address_postal_code, image) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        ;

        //preparing the query statement 
        $stmt = $db->connect()->prepare($sql);
        $stmt->bind_param('ssddsssssssssssss', $patientFname, $patientLname, $height, $weight, $marital_status, $nationality, $sex, $dob, $telephone, $healthID, $BMI, $bloodType, $streetAddr, $city, $state, $PostalCode, $dst1);


        //checking the execution of the query statement
        if ($stmt->execute()) {
        
            $response['message'] = "Success";
        
            return true;

        } else {
            return false;

        }
    
    }





    public function Display_All_Patients()
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        //A query to get all prisoners details

        $sql = "SELECT patientid, firstname, lastname,
        BMI,
        Sex,
        bloodtype,
        Nationality
        FROM
        patients";

        //executing the query
        $results = $db->connect()->query($sql);

        //Checking if rows have been affected 
        if ($results->num_rows > 0) {
            $data = array();
            while ($row = $results->fetch_assoc()) {

                //Saving data in an associative array
                $data[] = $row;
            }

            //returning the data
            return $data;
        } else {
            echo "No found records";
        }
    }

    //A method to display a prisoner Detail
    public function DisplayPatientBio($id)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        //A query to select a specific prisoner by his/her ID
        $sql1 = "SELECT * from patients where patientid = '$id'";

        //Executing the query
        $result = $db->connect()->query($sql1);

        //checking if the query affected any row then is a success
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }
    }

    

   



    //a method to update the prisoner Information
    public function updatePatientInfo($id)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        //getting the post data from the form and checking
        $idUpdate = $db->connect()->real_escape_string($_POST['patient_id']);
        $fname = $db->connect()->real_escape_string($_POST['pFname']);
        $lname = $db->connect()->real_escape_string($_POST['pLname']);
        $BMI = $db->connect()->real_escape_string($_POST['BMI']);
        $bloodType = $db->connect()->real_escape_string($_POST['bloodType']);
        $dob = $db->connect()->real_escape_string($_POST['dob']);
        $Marital_Status = $db->connect()->real_escape_string($_POST['marital_status']);
        $Height_feets = $db->connect()->real_escape_string($_POST['height']);
        $Weight_kg = $db->connect()->real_escape_string($_POST['weight']);
        $Sex = $db->connect()->real_escape_string($_POST['gender']);
        $Nationality = $db->connect()->real_escape_string($_POST['nationality']);
        $Patient_tel = $db->connect()->real_escape_string($_POST['telephone']);
        $HealthID = $db->connect()->real_escape_string($_POST['healthID']);
        $address_street = $db->connect()->real_escape_string($_POST['streetAddr']);
        $address_city = $db->connect()->real_escape_string($_POST['city']);
        $address_region = $db->connect()->real_escape_string($_POST['state']);
        $address_postal_code = $db->connect()->real_escape_string($_POST['PostalCode']);




        //A query to update the prisoner information 
        $updatePatient = $db->connect()->query(" UPDATE patients SET firstname='$fname', lastname='$lname', Height='$Height_feets', Weight='$Weight_kg', Sex='$Sex', DOB='$dob',
        healthID='$HealthID', BMI='$BMI', bloodtype='$bloodType', patient_tel='$Patient_tel', address_street='$address_street', address_city='$address_city',
        address_region='$address_region', address_postal_code='$address_postal_code', Marital_Status='$Marital_Status' WHERE patientid= '$idUpdate' ");

        if ($updatePatient) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_medication($post) {
         //creating an instance of db_connection 
        $db = new DB_connection();

        $pat_id = $db->connect()->real_escape_string($_POST['patient_id']);
        $allergies = $db->connect()->real_escape_string($_POST['allergies']);
        $asthma = $db->connect()->real_escape_string($_POST['asthma']);
        $stds = $db->connect()->real_escape_string($_POST['stds']);
        $diagnosis = $db->connect()->real_escape_string($_POST['diagnosis']);
        

        $sql = "INSERT INTO medical_report(patientid, Asthma, STD, Allergies, diagnosis) 
        VALUES('$pat_id', '$asthma', '$stds', '$allergies', '$diagnosis')";


        //Executing the query
        $result = $db->connect()->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

}
