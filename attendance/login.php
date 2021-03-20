<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Login - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
</head>

<body class="bg-gradient-primary">
    <?php
    session_start();
    include("../conn.php");
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;./assets/img/dogs/image2.png&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Student Login</h4>
                                    </div>

                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="department">Organization:</label>
                                                <select class="form-control col-12 form-control-sm custom-select custom-select-sm" name="college" required id="college">
                                                    <?php
                                                    $dl = "users";
                                                    $q = "SELECT name, username FROM " . $dl;
                                                    $qq = mysqli_query($conn, $q);
                                                    $username = "";
                                                    if (mysqli_num_rows($qq) > 0) {
                                                        while ($row = mysqli_fetch_assoc($qq)) {
                                                            echo "<option value=" . $row['username'] . " name=" . $row['username'] . ">" . $row['name'] . "</option>";
                                                            $username = $row['username'];
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label for="branch">Branch:</label>
                                            <select class="form-control col-12 form-control-sm custom-select custom-select-sm" name="department" required id="department">
                                                <?php
                                                $department = "";
                                                if (isset($_GET['department'])) {
                                                    $department = $_GET['department'];
                                                }
                                                $dl = $_SESSION['username'] . "_departments";
                                                $q = "SELECT codename FROM " . $dl;
                                                $qq = mysqli_query($conn, $q);

                                                if (mysqli_num_rows($qq) > 0) {
                                                    while ($row = mysqli_fetch_assoc($qq)) {
                                                        if ($row['codename'] == $department) {
                                                            echo "<option selected value=" . $row['codename'] . ">" . $row['codename'] . "</option>";
                                                        } else {
                                                            echo "<option value=" . $row['codename'] . ">" . $row['codename'] . "</option>";
                                                        }
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group"><input class="form-control form-control-user" type="text" placeholder="Enter Student ID" name="username"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" placeholder="Password" name="password"></div>
                                        <div class="form-group">

                                        </div><input class="btn btn-primary btn-block text-white btn-user" type="submit" name="login" value="Login">
                                        <hr>
                                        <p class="lead text-danger"><?php
                                                                    if (isset($_SESSION['student'])) {
                                                                        header("location:index.php");
                                                                    }
                                                                    if (isset($_POST['login'])) {
                                                                        $username = $_POST['username'];
                                                                        $password = $_POST['password'];
                                                                        $department = $_POST['department'];
                                                                        $college = $_POST['college'];
                                                                        if ($username != "" && $password != "" && $department != "") {
                                                                            $q = "SELECT collegeid, password from ".$college."_".$department."_students  where collegeid = '" . $username . "' and password = '" . $password . "'";
                                                                            echo $q;
                                                                            if (mysqli_num_rows(mysqli_query($conn, $q)) > 0) {
                                                                                $_SESSION['username'] = $username;
                                                                                header('location:./index.php');
                                                                            } else {
                                                                                echo "Wrong Id or Password";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></p>
                                    </form>
                                    <!-- <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>