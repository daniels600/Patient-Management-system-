<?php

require_once '../controllers/patientController.php';

$patient = new Patient();

if (isset($_GET['error'])){
    $err_msg ="Oops! Something went wrong check your information again";
}

if (isset($_GET['id']) || isset($idUpdate)) {
    $patientID = isset($_GET['id'])? $_GET['id'] : $idUpdate;



    // $sql1 = "SELECT * from prisoner where Prisoner_id = '$prisonerId'";
    // $sql2 = "SELECT * from Prisoner_case where Prisoner_id = '$prisonerId'";


    $patientInfo = $patient->DisplayPatientBio($patientID);
    //$record =  $patient->getPrisonerCase($patientID);

    if (isset($patientInfo)) {
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
}
// if (isset($record)) {
//     $Latest_Possible_Date = $record['Latest_Possible_Date'];
// }


if (isset($_POST['update'])) {
    if($patient->updatePatientInfo($prisonerId)){
        header('location: ../views/patient.php?edit=success');
    } else{
        header('location: ./actions/updatePatient.php?error=failed');
    }
    
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Update Patient Record</title>
    <link rel="icon" href="../assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="bg-primary" style="background-color: #cffffe !important;">
    <div style="margin-top: 2%; margin-left: 3%">
        <a type="button" class="btn btn-primary" href='../views/patient.php'><b>Back</b></a>
    </div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Patient's Record</h3>
                                </div>
                                <div class="card-body">
                                <?php
                                if (isset($err_msg)) {
                                    echo '<div class="alert alert-danger">' .
                                    $err_msg
                                    . '</div>';
                                }

                                ?>
                                  <!-- Using parsley js to validate the form inputs and regex -->
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' id='Patient_info' enctype="multipart/form-data" data-parsley-validate>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="FirstName">First Name</label>
                                                    <input class="form-control py-4" id="FirstName" type="text" placeholder="Enter first name" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-error-message="Please enter a valid First name without spaces" data-parsley-trigger="keyup" name='pFname' value="<?php echo $fname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="LastName">Last Name</label>
                                                    <input class="form-control py-4" id="LastName" type="text" placeholder="Enter last name" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z]+$" data-parsley-error-message="Please enter a valid Last name without spaces" data-parsley-trigger="keyup" name='pLname' value="<?php echo $lname; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="nationality">Nationality</label>
                                            <input class="form-control py-4" id="nationality" type="text" placeholder="Enter nationality" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" name='nationality' value="<?php echo $Nationality; ?>" />
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="height">Height</label>
                                                    <input class="form-control py-4" id="height" type="number" placeholder="Enter Height" step="0.01" min="0" data-parsley-required="true" data-parsley-type="number" data-parsley-trigger="keyup" name='height' value="<?php echo $Height_feets; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="weight">Weight </label>
                                                    <input class="form-control py-4" id="weight" type="number" placeholder="Enter Weight" step="0.01" min="0" data-parsley-required="true" data-parsley-type="number" data-parsley-trigger="keyup" name='weight' value="<?php echo $Weight_kg; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label><br>
                                            <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="dob" id="dob" data-parsley-required="true" data-parsley-trigger="keyup" value="<?php echo $dob; ?>">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sex">Sex</label>
                                                <select class="custom-select mr-sm-2" id="sex" data-parsley-trigger="keyup" name='gender' required>
                                                    <option value="">Choose...</option>
                                                    <option value="Male" <?= ($Sex == 'Male') ? 'selected' : "" ?>>Male</option>
                                                    <option value="Female" <?= ($Sex == 'Female') ? 'selected' : "" ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="marital_status">Marital Status</label>
                                                <select class="custom-select mr-sm-2" id="marital_status" data-parsley-trigger="keyup" name='marital_status'>
                                                    <option value="">Choose...</option>
                                                    <option value="Single" <?= ($Marital_Status == "Single") ? 'selected' : "" ?>>Single</option>
                                                    <option value="Married" <?= ($Marital_Status == "Married") ? "selected" : "" ?>>Married</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="Complexion">BMI</label>
                                                <input type="text" id="default-picker" class="form-control" placeholder="BMI" data-parsley-required="true" name="BMI" value="<?php echo $BMI; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telephone">Telephone</label>
                                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telephone" data-parsley-required="true" data-parsley-pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" value="<?php echo $Patient_tel; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="blood">Blood Type</label><br>
                                            <select class="custom-select mr-sm-2" id="bloodtype" name="bloodType" data-parsley-trigger="keyup" required>
                                                    <option value="">Choose...</option>
                                                    <option value="A" <?= ($bloodtype == 'A') ? 'selected' : "" ?> >A</option>
                                                    <option value="B" <?= ($bloodtype == 'B') ? 'selected' : "" ?> >B</option>
                                                    <option value="AB" <?= ($bloodtype == 'AB') ? 'selected' : "" ?> >AB</option>
                                                    <option value="O" <?= ($bloodtype == 'O') ? 'selected' : "" ?> >O</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="sentenceLength">Health Insurance ID</label>
                                                <input class="form-control py-4" type="number" placeholder="Insurance ID" data-parsley-required="true" data-parsley-error-message="Please enter a figure only" name="healthID" value="<?php echo $healthID; ?>"/>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="streetAddr">Street Address</label>
                                                <input type="text" class="form-control" id="streetAddr" placeholder="Street Address" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z0-9.,\- ]*$" name="streetAddr" value="<?php echo $address_street; ?>">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z0-9.,- ]*$" value="<?php echo $address_city; ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="region">Region</label>
                                                <input type="text" class="form-control" id="region" placeholder="region" name="state" data-parsley-pattern="^[a-zA-Z ]*$" required value="<?php echo $address_region; ?>">

                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="PostalCode">PostalCode</label>
                                                <input type="text" class="form-control" id="PostalCode" placeholder="PostalCode" data-parsley-pattern="^[a-zA-Z0-9., \/ ]*$" name="PostalCode" required value="<?php echo $address_postal_code; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="patient_id" value="<?php echo $patientID; ?>">
                                        </div>
                                        <!-- Checking for an error with image -->
                                        <label>Patient's Image</label>
                                        <?php if (isset($_GET['error'])) {
                                            if ($_GET['error'] == 'wrongImage') {
                                                echo "Upload a *jpeg  *gif *png *jpg";
                                            }
                                        } ?>
                                        <br />

                                        <div class="profile-img" style="margin-bottom: 5%;">
                                            <img src="<?php echo $imageSrc; ?>" />
                                        </div>
                                        <button type="submit" name="update" class="btn btn-success btn-lg btn-block" required>Update Record</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SE TEAM 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Creating and showing a flash message or alert if any -->
    <?php if (isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <?php if (isset($_GET['edit'])) : ?>
        <div class='flash-edit' data-flashedit="<? $_GET['edit'];?>"></div>
    <?php endif; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        //using sweetAlert to display alert 
        const flashdata = $('.flash-data').data('flashdata');

        if (flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Record updated successfully',
                text: 'Patient updated!',
                allowOutsideClick: false,
                allowEscapeKey: false,
                footer: '<a href=patient.php>Click here!</a>',
                type: "success"
            }).then(function() {
                window.location.href = 'patient.php';
            });
        }


        const flashedit = $('.flash-edit').data('flashedit');

        if (flashedit) {
            Swal.fire({
                icon: 'success',
                type: 'success',
                title: 'Record updated',
                text: 'Patient record updated!',

            }).then(function() {
                window.location.href = 'patient.php';
            });
        }

    </script>
</body>

</html>