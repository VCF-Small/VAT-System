<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>Your QR - VAT Student</title>
</head>

<body>
    <?php
    session_start();
    include("../conn.php");
    if(!isset($_SESSION['student'])){
        header("location:./login.php");
    }
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="../index.php">VAT</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
        </div>
    </nav>
    <div class="container">
        <div class="row" style="margin: 20px;">
            <script>
                window.onload = () => {
                    var deparment = document.getElementById("department").value;
                    $("#class_select").load("./loadclass.php?department=" + deparment);
                }
                $(document).ready(function() {
                    $('#department').change(function() {
                        var deparment = document.getElementById("department").value;
                        $("#class_select").load("./loadclass.php?department=" + deparment);
                    });
                    $("#start").click(function(e) {
                        e.preventDefault();
                        var deparment = document.getElementById("department").value;
                        $('#studentlist').load("./loadstudents.php?department=" + deparment);
                        $('#donenot').text(" ");
                        $('#submitbuttondiv').html('<input type="submit" class="btn btn-md btn-success" value="Submit Attendance" id="submit" name="submit">');
                        $('#camerasection').load("loadcamera.php");
                    });
                });
            </script>
            <div class="col text-center">
                <form method="post">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-5 col-lg-3">
                            <label for="department">Department</label>
                            <select name="department" class="form-control form-control-sm custom-select custom-select-sm" required id="department">
                                <?php
                                $dl = $_SESSION['username'] . "_departments";
                                $q = "SELECT codename FROM " . $dl;
                                $qq = mysqli_query($conn, $q);

                                if (mysqli_num_rows($qq) > 0) {
                                    while ($row = mysqli_fetch_assoc($qq)) {
                                        echo "<option value=" . $row['codename'] . ">" . $row['codename'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-3">
                            <label for="department">Class</label>
                            <select id="class_select" name="class" class="form-control form-control-sm custom-select custom-select-sm" required>

                            </select>
                        </div>
                        <div class=" justify-content-center col-sm-2 col-xs-12 col-md-2 col-lg-2">
                            <input type="submit" class="btn btn-sm btn-primary" style="margin-top: 31px; float:left;" value="Start" id="start" name="start">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="camerasection" class="row"></div>
        <div class="justify-content-center" align="center">

        </div>
    </div>
</body>


</html>