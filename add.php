<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$kota = $sembuh = $dirawat = $meninggal = $total = "";
$kota_err = $sembuh_err = $dirawat_err = $meninggal_err = $total_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Kota
    if (empty(trim($_POST["kota"]))) {
        $kota_err = "Please enter the city name.";
    } else {
        $kota = trim($_POST["kota"]);
    }

    // Validate Sembuh
    if (empty(trim($_POST["sembuh"]))) {
        $sembuh_err = "Please enter the number of recovered cases.";
    } else {
        $sembuh = trim($_POST["sembuh"]);
    }

    // Validate Dirawat
    if (empty(trim($_POST["dirawat"]))) {
        $dirawat_err = "Please enter the number of active cases.";
    } else {
        $dirawat = trim($_POST["dirawat"]);
    }

    // Validate Meninggal
    if (empty(trim($_POST["meninggal"]))) {
        $meninggal_err = "Please enter the number of deaths.";
    } else {
        $meninggal = trim($_POST["meninggal"]);
    }

    // Check input errors before inserting into database
    if (empty($kota_err) && empty($sembuh_err) && empty($dirawat_err) && empty($meninggal_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO data_covid (kota, sembuh, dirawat, meninggal) VALUES (:kota, :sembuh, :dirawat, :meninggal)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":kota", $param_kota, PDO::PARAM_STR);
            $stmt->bindParam(":sembuh", $param_sembuh, PDO::PARAM_INT);
            $stmt->bindParam(":dirawat", $param_dirawat, PDO::PARAM_INT);
            $stmt->bindParam(":meninggal", $param_meninggal, PDO::PARAM_INT);

            // Set parameters
            $param_kota = $kota;
            $param_sembuh = $sembuh;
            $param_dirawat = $dirawat;
            $param_meninggal = $meninggal; 

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to index page
                header("location: tables_admin.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add - Fian</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar.php') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('topbar.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="text" name="kota" class="form-control <?php echo (!empty($kota_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $kota; ?>">
                                    <span class="invalid-feedback"><?php echo $kota_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Sembuh</label>
                                    <input type="number" name="sembuh" class="form-control <?php echo (!empty($sembuh_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sembuh; ?>">
                                    <span class="invalid-feedback"><?php echo $sembuh_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Dirawat</label>
                                    <input type="number" name="dirawat" class="form-control <?php echo (!empty($dirawat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dirawat; ?>">
                                    <span class="invalid-feedback"><?php echo $dirawat_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Meninggal</label>
                                    <input type="number" name="meninggal" class="form-control <?php echo (!empty($meninggal_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $meninggal; ?>">
                                    <span class="invalid-feedback"><?php echo $meninggal_err; ?></span>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="tables_admin.php" class="btn btn-secondary ml-2">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>