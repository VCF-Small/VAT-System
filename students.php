<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        session_start();
        include("conn.php");
        include("navbar.php");
        ?>
        <?php
        if (!isset($_SESSION['username'])) {
            header("location:login.php");
        }
        ?>
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Students</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Student Information</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6 ">
                            <?php
                            if (isset($_POST['show'])) {
                                $department = $_POST['department'];
                                echo "$department";
                                header("location: ./students.php?department=" . $department . "");
                            }
                            ?>
                            <form method="post">
                                <select class="form-control form-control-sm custom-select custom-select-sm" name="department" required id="department">
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
                        <div class=" col-sm-6 col-xs-6">
                            <input class="btn btn-sm btn-primary" type="submit" name="show" value="Show">
                        </div>
                        </form>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php



                                if (isset($_SESSION['username'])) {
                                    if (isset($_GET['department'])) {
                                        $department = $_GET['department'];
                                        $cl = $_SESSION['username'] . "_" . $department . "_students";
                                        $q = "SELECT name,collegeid, age, gender, address  FROM " . $cl;
                                        $qq = mysqli_query($conn, $q);
                                        //         <td>Computer Science</td>
                                        // <td>Dr. Sunil Kumar Jangid</td>
                                        // <td><a href="#" class="btn btn-success btn-sm">Edit</a></td>
                                        if (mysqli_num_rows($qq) > 0) {
                                            while ($row = mysqli_fetch_assoc($qq)) {
                                                echo "<tr><td><a href=./profile.php?college=" . $_SESSION['username'] . "&department=" . $department . "&id=" . $row['collegeid'] . ">" . $row['name'] . "</a></td>
                                                    <td>" . $row['collegeid'] . "</td>
                                                    <td>" . $row['age'] . "</td>
                                                    <td>" . $row['gender'] . "</td>
                                                    <td>" . $row['address'] . "</td></tr>";
                                            }
                                        }
                                    }
                                } else {
                                    echo '<script type="text/javascript">location.href = "./login.php";</script>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>