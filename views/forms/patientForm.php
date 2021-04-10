
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Patient Data</title>
    <link rel="icon" href="../../assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <link href="../../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../../assets/js/scripts.js"></script>
</head>

<body class="bg-primary" style="background-color: #FFF5C0 !important;">
    <div style="margin-top: 2%; margin-left: 3%">
        <a type="button" class="btn btn-primary" href='../patient.php'><b>Back</b></a>
    </div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" style="margin-bottom: 5%">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Patient Information</h3>
                                </div>
                                <?php 
                                if(isset($_GET['errors'])){
                                    echo "Invalid Form Filled";
                                }
                                
                                ?>
                                <div class="card-body">
                                    <!-- Using parsley js to validate the form inputs and regex -->
                                    <form action='../../actions/insertPatient.php' id='patient_info' data-parsley-validate method='POST' enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="FirstName">Patient First Name</label>
                                                    <input class="form-control py-4" id="FirstName" type="text" placeholder="Enter first name"  data-parsley-required="true" data-parsley-pattern="^[a-zA-Z ]+$" name="pFname" data-parsley-error-message="Please enter a valid First name without spaces" data-parsley-trigger="keyup"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="LastName">Patient Last Name</label>
                                                    <input class="form-control py-4" id="LastName" type="text" placeholder="Enter last name"  data-parsley-required="true" data-parsley-pattern="^[a-zA-Z ]+$" name="pLname" data-parsley-error-message="Please enter a valid Last name without spaces" data-parsley-trigger="keyup"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sex">Sex</label>
                                                <select class="custom-select mr-sm-2" id="sex" data-parsley-trigger="keyup" name='gender' required>
                                                    <option value="">Choose...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="marital_status">Marital Status</label>
                                                <select class="custom-select mr-sm-2" id="marital_status" data-parsley-trigger="keyup" name='marital_status' required>
                                                    <option value="">Choose...</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height">Height</label>
                                                    <input class="form-control py-4" id="height" type="number" placeholder="Enter Height" step="0.01" min="0" data-parsley-required="true" data-parsley-type="number" data-parsley-trigger="keyup" name='height' />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="weight">Weight </label>
                                                    <input class="form-control py-4" id="weight" type="number" placeholder="Enter Weight" step="0.01" min="0" data-parsley-required="true" data-parsley-type="number" data-parsley-trigger="keyup" name='weight' />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="streetAddr">Street Address</label>
                                                <input type="text" class="form-control" id="streetAddr" placeholder="Street Address" data-parsley-required="true" data-parsley-pattern="[ A-Za-z0-9 _.,\/+-]*$" name="streetAddr" data-parsley-trigger="keyup" >
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City" data-parsley-required="true" data-parsley-pattern="^[ A-Za-z0-9 z.,\/+-]*$" data-parsley-trigger="keyup" >
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="state">Region</label>
                                                <input type="text" class="form-control" id="state" placeholder="State" name="state" data-parsley-pattern="^[A-Za-z -]*$" data-parsley-trigger="keyup" required>

                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="PostalCode">PostalCode</label>
                                                <input type="text" class="form-control" id="PostalCode" placeholder="PostalCode" name="PostalCode" data-parsley-pattern="^[ A-Za-z0-9 _.,\/+-]*$" data-parsley-trigger="keyup" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="Complexion">BMI</label>
                                                <input type="text" id="default-picker" class="form-control" placeholder="BMI" data-parsley-required="true" name="BMI">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telephone">Telephone</label>
                                                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telephone" data-parsley-required="true" data-parsley-pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" data-parsley-trigger="keyup" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nationality">Nationality</label>
                                            <input class="form-control py-4" id="nationality" type="text" placeholder="Enter nationality" data-parsley-required="true"  data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" name='nationality' />
                                        </div>
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label><br>
                                            <input type="date" placeholder="yyyy-mm-dd" class="form-control" name="dob" id="dob" data-parsley-required="true" data-parsley-trigger="keyup">
                                        </div>
                                        <div class="form-group">
                                            <label for="blood">Blood Type</label><br>
                                            <select class="custom-select mr-sm-2" id="bloodtype" name="bloodType" data-parsley-trigger="keyup" required>
                                                    <option value="">Choose...</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                    <option value="O">O</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="sentenceLength">Health Insurance ID</label>
                                                <input class="form-control py-4" type="number" placeholder="Insurance ID" data-parsley-required="true" data-parsley-error-message="Please enter a figure only" name="healthID"/>
                                        </div>
                                        <div class="form-group">
                                            <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"></p>
                                            <p><label class="btn btn-primary"for="file" style="cursor: pointer;">Upload Image</label></p>
                                            <p><img id="output" width="200" name="image"/></p>
                                           
                                        </div>
                                        <?php if(isset($_GET['error'])){if($_GET['error'] == 'wrongImage') {echo "Upload a *jpeg  *gif *png *jpg";}}?>
                                        <br />
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Save Record</button>
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
     <!-- Getting the message from the insertion of case record and creating a flash message --> 
    <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    // creating a display message
    const flashdata = $('.flash-data').data('flashdata');

        if(flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Patient record saved!',
                text: 'New patient record saved successfully',
                footer: '<a href=../patient.php>Click here!</a>',  
                type: "success" 
            }).then(function () {
                window.location.href = '../patient.php';
            });
        }

        //Preview the inserted image 
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
    
</body>

</html>