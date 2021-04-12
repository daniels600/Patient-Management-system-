<?php

require_once '../controllers/patientController.php';

//checking for an id in the url to this page 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    //creating an instance of Patient
    $patient = new Patient();

    //storing the patient bio in a variable
    $patientBio = $patient->DisplayPatientBio($id);

    //getting the patient's image
    $image = isset($patientBio['image'])? $patientBio['image'] : "";
    $imageSrc = "../". $image;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <title>View Details</title>
  <link rel="icon" href="../assets/images/imageedit_28_3939584200.png" type="image/png">
</head>

<body>
  <br />
  <div class="container emp-profile">
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img src="<?php echo $imageSrc; ?>" > 
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h3>
            <?php echo 'Name: '.$patientBio['firstname'] . ' ' . $patientBio['lastname']; ?>
          </h3>
          <h3>
            <p>Blood Type: <?php echo $patientBio['bloodtype']; ?></p>
          </h3>
          <h3>
            <p>NHIS: <?php echo $patientBio['healthID']; ?></p>
          </h3>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="./forms/medication.php?id=<?php echo $id; ?>" role="tab" aria-controls="profile" aria-selected="false">Add Medications report</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <a class="btn btn-primary" href="patient.php" role="button">Back</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">

      </div>
    </div>
    <div class="col-md-8">
      <div class="tab-content profile-tab" id="myTabContent" style='padding-left:40%; text-align:center;font-size:large'>
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
            <div class="col-md-6">
              <label><strong>Nationality</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['Nationality']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Gender</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['Sex']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Date of Birth</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['DOB']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Marital Status</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['Marital_Status']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Contact</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['patient_tel']; ?></p>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <label><strong>Height</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['Height'].' metres'; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Weight</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['Weight'].' pounds'; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Address</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['address_street'].' '.$patientBio['address_city'].' '.$patientBio['address_region'].' '.$patientBio['address_postal_code']; ?></p>
            </div>
          </div>
          <hr/>
        </div>
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style='padding-left:40%; text-align:center'>
          <div class="row">
            <div class="col-md-6">
              <label><strong>BMI</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['BMI']; ?></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label><strong>Blood Type</strong></label>
            </div>
            <div class="col-md-6">
              <p><?php echo $patientBio['bloodtype']; ?></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  </div>
</body>

</html>