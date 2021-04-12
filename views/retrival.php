<?php


require_once '../controllers/patientController.php';


//creating an instance of db_connection 
$db = new DB_connection();


if(isset($_POST)){
  $p_id = $_POST['p_id'];
  $tel = $_POST['phone'];


  $sql = "SELECT * FROM patients WHERE patientid= '$p_id'";

  $sql2 = "SELECT * FROM medical_report ORDER BY time_recorded DESC LIMIT 1";

  $result = $db->connect()->query($sql);

  $result2  = $db->connect()->query($sql2);

  if ($result->num_rows > 0) {
    // output data of each row
    while($patientInfo = $result->fetch_assoc()) {
      
        $fname = isset($patientInfo['firstname'])?$patientInfo['firstname'] : "";
        $lname = isset($patientInfo['lastname'])?$patientInfo['lastname'] : "";
        $dob = isset($patientInfo['DOB'])?$patientInfo['DOB']:"";
        $Marital_Status = isset($patientInfo['Marital_Status'])?$patientInfo['Marital_Status']:"";
        $Height_feets = isset($patientInfo['Height'])?$patientInfo['Height']:"";
        $Weight_kg = isset($patientInfo['Weight'])?$patientInfo['Weight']:"";
        $Sex = isset($patientInfo['Sex'])?$patientInfo['Sex']:"";
        $Nationality = isset($patientInfo['Nationality'])?$patientInfo['Nationality']:"";
        $Patient_tel = isset($patientInfo['patient_tel'])?$patientInfo['patient_tel']:"";
        $bloodtype = isset($patientInfo['bloodtype'])?$patientInfo['bloodtype']:"";
        $BMI = isset($patientInfo['BMI'])?$patientInfo['BMI']:"";
        $healthID = isset($patientInfo['healthID'])?$patientInfo['healthID']:"";
        $address_street = isset($patientInfo['address_street'])?$patientInfo['address_street']:"";
        $address_city = isset($patientInfo['address_city'])?$patientInfo['address_city']:"";
        $address_region = isset($patientInfo['address_region'])?$patientInfo['address_region']:"";
        $address_postal_code = isset($patientInfo['address_postal_code'])?$patientInfo['address_postal_code']:"";
        $image = $patientInfo['image'];
        $imageSrc = "../". $image;
    }

    if($result2->num_rows > 0){

      while($row= $result2->fetch_assoc()) {
        $asthma = isset($row['Asthma'])?$row['Asthma']:"";
        $STD = isset($row['STD'])?$row['STD']:"";
        $Allergies = isset($row['Allergies'])?$row['Allergies']:"";
        $diagnosis = isset($row['diagnosis'])?$row['diagnosis']:"";
        $time_recorded = isset($row['time_recorded'])?$row['time_recorded']:"";
        
      }
      
    }
  } else {
    header('Location: userdata.php?error=userNotfound');
  }


}


?>
<!DOCTYPE html>
<html>
<header>
  <meta charset="UTF-8">
  <script src="script.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style5.css">
  <nav>
    <div class="float-right">
      <button onclick="window.location.href='../retrival.php'">ADMIN</button>
      <button onclick="window.location.href='../index.php'">HOME</button>
    </div>
  </nav>
</header>

<body>
  <div class="container">
    <img src= "<?php echo $imageSrc; ?>" alt="contact icon">
    <div>
      <div>
        <label class="labeltr">Name</label>
        <label class="feilds"><?php echo $fname ." ". $lname?></label>
      </div>
      <div>
        <label class="labeltr">Date of Birth :</label>
        <label class="feilds"><?php echo $dob; ?></label>
      </div>
      <div>
        <label class="labeltr">Height :</label>
        <label class="feilds"><?php echo $Height_feets; ?></label>
      </div>
      <div>
        <label class="labeltr">Weight</label>
        <label class="feilds"><?php echo $Weight_kg; ?></label>
      </div>
      <div>
        <label class="labeltr">Adress</label>
        <label class="feilds"><?php echo $address_city ." ". $address_street. " ". $address_postal_code;?></label>
      </div>
      <div>
        <label class="labeltr">Sex</label>
        <label class="feilds"><?php echo $Sex; ?></label>
      </div>
      <div>
        <label class="labeltr">Phone</label>
        <label class="feilds"><?php echo $Patient_tel; ?></label>
      </div>
      <div>
        <label class="labeltr">BMI</label>
        <label class="feilds"><?php echo $BMI; ?></label>
      </div>
      <div>
        <label class="labeltr">Blood Type</label>
        <label class="feilds"><?php echo $bloodtype; ?></label>
      </div>
      <div>
        <label class="labeltr">Date Last Checked</label>
        <label class="feilds"><?php echo $time_recorded; ?></label>
      </div>
      <div>
        <label class="labeltr">Asthma</label>
        <label class="feilds"><?php echo $asthma; ?></label>
      </div>
      <div>
        <label class="labeltr">STDs</label>
        <label class="feilds"><?php echo $STD; ?></label>
      </div>
      <div>
        <label class="labeltr">Allergies</label>
        <label class="feilds"><?php echo $Allergies; ?></label>
      </div>
      <div>
        <label class="labeltr">Diagnosis/Prescription</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>
          <?php echo $diagnosis; ?>
        </textarea>
      </div>
    </div>
  </div>
</body>

</html>