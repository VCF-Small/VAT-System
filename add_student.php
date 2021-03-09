<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Student - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
</head>

<body id="page-top">
    <?php
    session_start();
    include("conn.php");
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }

    ?>
    <div id="wrapper">
        <?php
        include("conn.php");
        include("navbar.php");
        ?>
        <div class="container-fluid">
            <h3 class="text-dark mb-4">Add Student</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Enter Data</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <?php
                            if (isset($_POST['add'])) {
                                $department = $_POST['department'];
                                $name = $_POST['name'];
                                $age = $_POST['age'];
                                $gender = $_POST['gender'];
                                $address = $_POST['address'];

                                if ($department != "" && $name != "" && $age != "" && $gender != "" && $address != "") {
                                    $cl = $_SESSION['username'] . "_" . $department;
                                    $cls = $_SESSION['username'] . "_" . $department . "_students";
                                    $sq = "SELECT collegeid FROM " . $cls . " ORDER BY collegeid DESC LIMIT 1";
                                    $collegeid = 1;
                                    $result = mysqli_query($conn, $sq);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $collegeid = $row['collegeid'];
                                        }
                                        $collegeid += 1;
                                    }
                                    
                                    $scq = "SELECT codename FROM " . $cl;
                                    $ctq = "CREATE TABLE IF NOT EXISTS " . $cl . "_" . $collegeid . " ( `id` INT(10) NOT NULL AUTO_INCREMENT, `date` VARCHAR(20) NOT NULL";
                                    $result = mysqli_query($conn, $scq);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $ctq .= ", `" . $row['codename'] . "` CHAR(1) NOT NULL";
                                        }
                                        
                                    }
                                    $ctq .= ", PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                                    $iq = "INSERT INTO " . $cls . "(name, collegeid, age, gender, address) VALUES('" . $name . "', '" . $collegeid . "', '" . $age . "', '" . $gender . "', '" . $address . "')";
                                    if (mysqli_query($conn, $iq)) {
                                        if (mysqli_query($conn, $ctq)) {
                                            echo "<p style='color:green'>Student Was Added Successfully</p>";
                                        }
                                    }
                                } else {
                                    echo "Please Fill All The Entries";
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-4 col-md-2">
                                        <label>Department</label>
                                        <select class="form-control form-control-sm custom-select custom-select-sm" name="department" required id="department">
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
                                    <div class="col-sm-8 col-md-8">
                                        <label for="name">Name</label>
                                        <input type="text" required class="form-control form-control-sm" name="name">
                                    </div>
                                    <div class="col-6 col-sm-8 col-md-2">
                                        <label for="name">Age</label>
                                        <input type="number" required class="form-control form-control-sm" name="age" id="age">
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <label for="name">Gender</label>
                                        <select class="form-control form-control-sm custom-select custom-select-sm" required name="gender" id="department">
                                            <option value="Male" selected="">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <label for="name">Address</label>
                                        <input type="text" required class="form-control form-control-sm" name="address">
                                    </div>

                                    <div class="col-4">
                                        <br>
                                        <input type="submit" name="add" value="Add" class="btn btn-small btn-success">
                                    </div>
                                </div>

                            </form>
                        </div>



                    </div>
                    <!-- <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Address</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>Male</td>
                                </tr>

                            </tbody>

                        </table>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-white sticky-footer">

    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>