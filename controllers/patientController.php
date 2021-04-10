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
            //getting the last inserted data idatient = mysqli_insert_id($db->conn);

            // $_SESSION['prisonerIatient;atient = isset($_SESSION['prisonerId']) ? $_SESSION['prisonerId'] : $this->getPrisonerID();

            $response['message'] = "Success";
            //$caseId = isset($_SESSION['caseId']) ? $_SESSION['caseId'] : $this->getCaseID();

            //query to insert into the prisoner_case table
            //$query = "INSERT INTO Prisoner_case(Case_id,Prisoner_id,Latest_Possible_Date)
            //VALUES('$caseatient','$release_date')";

            return true;

            // $result=0;

            // if ($result) {
            //     return true;
                
            // } else {
            //     $response['message'] = "Failed";
            //     return false;
            // }
        } else {
            return false;

        }
    
    }



    //A method to insert the case details
    public function insertCaseForm($post)
    {
        // session_start();
        $errors = [];

        //creating an instance of db_connection 
        $db = new DB_connection();

        //getting the post data from the form and checking
        $magFname = $db->connect()->real_escape_string($_POST['mFname']);
        $magLname = $db->connect()->real_escape_string($_POST['mLname']);
        $court = $db->connect()->real_escape_string($_POST['court']);
        $crime = $db->connect()->real_escape_string($_POST['crime']);
        $catOffence = $db->connect()->real_escape_string($_POST['CatOffence']);
        $caseStartDate = $db->connect()->real_escape_string($_POST['case_start_date']);
        $caseEndDate = $db->connect()->real_escape_string($_POST['case_end_date']);
        $crimeTime = $db->connect()->real_escape_string($_POST['crimeTime']);
        $dateCrime = $db->connect()->real_escape_string($_POST['crimeDate']);
        $sentence = $db->connect()->real_escape_string($_POST['sentenceLength']);

        //Validating the case details submitted 
        if(!preg_match("/^[a-zA-Z ]*$/", $magFname) && !preg_match("/^[a-zA-Z ]*$/", $magLname) && !preg_match("/^[a-zA-Z ]*$/", $court) && !preg_match("/^[a-zA-Z ]*$/", $crime) && !preg_match("/^[a-zA-Z ]*$/", $catOffence) && !preg_match("/^[0-9]*$/", $sentence)){
            $response['message'] = "Failed";
        }
        else{
            //  A query to insert a new case 
            $sql = "INSERT into Cases(case_start_date,case_end_date,crime_committed,Category_of_Offence,Crime_time,Crime_date, sentence_length_Years,Court_of_commital,Magistrate_fname,Magistrate_lname) 
            VALUES(?,?,?,?,?,?,?,?,?,?)";

            $stmt = $db->connect()->prepare($sql);
            $stmt->bind_param('ssssssdsss', $caseStartDate, $caseEndDate, $crime, $catOffence, $crimeTime, $dateCrime, $sentence, $court, $magFname, $magLname);


            if ($stmt->execute()) {

                $caseId = mysqli_insert_id($db->conn);

                //setting the caseId
                //$this->setCaseID($caseId);

                //Having a session for the caseId
                $_SESSION['caseId'] = $caseId;
                $response['message'] = "Success";

                // redirect if the case record was inserted successfully
                header('Location: ../views/forms/caseForm.php?message=success');
            } else {
                $response['message'] = "Failed";
            }

            //$stmt->close();
            echo json_encode($response);
            $stmt->close();
        }

    }


    public function insertPoliceOfficer($postdata)
    {
        session_start();

        //creating an instance of db_connection 
        $db = new DB_connection();

        //getting the post data from the form and checking
        $officerFname = $db->connect()->real_escape_string($_POST['pFname']);
        $officerLname = $db->connect()->real_escape_string($_POST['pLname']);
        $serviceId = $db->connect()->real_escape_string($_POST['serviceId']);
        $officerContact = $db->connect()->real_escape_string($_POST['pContact']);
        $stationContact = $db->connect()->real_escape_string($_POST['stationContact']);
        $ranks = $db->connect()->real_escape_string($_POST['ranks']);
        $stationName = $db->connect()->real_escape_string($_POST['stationName']);

        //Validating the police officer details submitted using regex
        if(!preg_match("/^[a-zA-Z ]*$/",  $officerFname) && !preg_match("/^[a-zA-Z ]*$/", $officerLname) && !preg_match("/^[a-zA-Z0-9 ]*$/", $serviceId) && !preg_match("/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/", $officerContact) && !preg_match("/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/", $stationContact) && !preg_match("/^[0-9]*$/", $stationName)){
            $response['message'] = "Failed";
        } else{
            // A query to insert a new policeOfficer record 
            $sql = "INSERT INTO Police_Officer(Service_ID, P_fname, P_lname,Ranks, Officer_contact,Police_Station,Station_Tel)
            VALUES(?,?,?,?,?,?,?)";

            $stmt = $db->connect()->prepare($sql);
            $stmt->bind_param('sssssss', $serviceId, $officerFname, $officerLname, $ranks, $officerContact, $stationName, $stationContact);


            // checking if query was a success
            if ($stmt->execute()) {
                $response['message'] = "Success";

                //Getting the last inserted policeOfficer data
                $policeOfficerId = mysqli_insert_id($db->conn);

                //$this->setPoliceOfficerID($policeOfficerId);

                $_SESSION['policeOfficeId'] =  $policeOfficerId;

                header('Location: ../views/forms/policeOfficerForm.php?message=success');

            } else {
                $response['message'] = "Failed";
                echo ("The error is " . mysqli_error($db->connect()));
            }
            // echo json_encode($response);
            $stmt->close();
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

    //A method to get the prisoner Case details 
    public function getPrisonerCase($id)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        $sql2 = "SELECT * from Prisoner_case where Prisoner_id = '$id'";

        $record =  $db->connect()->query($sql2);

        //checking if the query affected any row then is a success
        if ($record->num_rows > 0) {
            $row = $record->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }
    }

    //A method to get the Case Info details
    public function getCaseDetails($idCase)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        // A query to get a specific case information
        $sql3 = "SELECT * from Cases where Case_id = '$idCase'";
        $case_record =   $db->connect()->query($sql3);


        //checking if the query affected any row then is a success
        if ($case_record->num_rows > 0) {
            $row = $case_record->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }
    }

    //A method to get the PoliceOfficer details
    public function getOfficerDetails($id)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        $sql4 = "SELECT * from Police_Officer where P_Officer_Id = '$id'";
        $officerRecords = $db->connect()->query($sql4);


        //checking if the query affected any row then is a success
        if ($officerRecords->num_rows > 0) {
            $row = $officerRecords->fetch_assoc();
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


    //A method to delete a prisoner from the Database 
    public function deletePrisoner($id)
    {
        //creating an instance of db_connection 
        $db = new DB_connection();

        // a query to delete the prisoner record
        $sql = "DELETE FROM Prisoner WHERE Prisoner_id='$id'";

        //checking if the query is successful
        if ($db->connect()->query($sql)) {
            return true; 
        }else{
            return false;
        }
    }
}
