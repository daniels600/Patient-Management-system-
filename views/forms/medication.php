<?php


//checking for an id in the url to this page 
if(isset($_GET['id'])){
    $id = $_GET['id'];

}else{
    $id = "";
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
    <title>Medication Page</title>
    <link rel="icon" href="../../assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="../../assets/css/parsley.css" rel="stylesheet" />
</head>

<body class="bg-primary" style="background-color: #FFF5C0 !important;">
    <div style="margin-top: 2%; margin-left: 3%">
        <a type="button" class="btn btn-primary" href='../viewPatient.php?id= <?php echo $id; ?>'><b>Back</b></a>
    </div>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" style="margin-bottom: 5%">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Medication Report</h3>
                                </div>
                                <?php
                                    //Showing a message if any for errors
                                    if (isset($_GET['error'])) {
                                        echo '<div class="alert alert-danger">' .
                                        '<li style="text-align:center">'.'Insertion Unsuccessful'.'</li>'
                                        . '</div>';
                                    }

                                    ?>
                                <div class="card-body">
                                     <!-- Using parsley js to validate the form inputs -->
                                    <form action='../../actions/insertMedication.php' method="POST" id='visitor_info' data-parsley-validate>
                                        <div class="form-group">
                                            <label class="small mb-1" for="rel">STDs</label>
                                            <input class="form-control py-4" name="stds" type="text" placeholder="Enter relation" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z- ]+$" data-parsley-trigger="keyup" data-parsley-error-message="Please enter a valid relation" />
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                    <label for="sex">Asthma</label>
                                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="asthma"  data-parsley-trigger="keyup" required>
                                                        <option value="">Choose...</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                    <label for="sex">Allergies</label>
                                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="allergies"  data-parsley-trigger="keyup" required>
                                                        <option value="">Choose...</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Doctor's Diagnosis/Prescription</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="diagnosis"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="patient_id" value="<?php echo $id; ?>">
                                        </div>
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
    <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    const flashdata = $('.flash-data').data('flashdata');

        if(flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Doctor\'s Diagnosis and Record saved!',
                text: 'Kindly click to go to the Patient\'s page',
                allowOutsideClick: false,
                allowEscapeKey: false,
                footer: '<a href= ../patient.php>Click here!</a>',  
                type: "success" 
            }).then(function () {
                window.location.href = '../patient.php';
            });
        }

    </script>
</body>

</html>