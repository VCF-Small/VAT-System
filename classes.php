<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Classess - VAT</title>
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
            <h3 class="text-dark mb-4">Classess</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Classess' Information</p>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6 ">
                            <?php
                            if (isset($_POST['show'])) {
                                $department = $_POST['department'];
                                echo "$department";
                                header("location: ./classes.php?department=" . $department . "");
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
                </div>
                <div class="card-body">
                <?php

            if (!isset($_GET['department'])) {
                $dl = $_SESSION['username'] . "_departments";
                $q = "SELECT codename FROM " . $dl . " ORDER BY ID ASC LIMIT 1";
                $result = mysqli_query($conn, $q);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<script> location.href='classes.php?department=" . $row['codename'] . "'</script>";
                }
            }
            ?>
                    <p class="lead">Add New Class</p>
                    <div class="row">
                        <div class="col-12">
                            <form method="post">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <label for="department">Department:</label>
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
                                    <div class="col-sm-12 col-md-9">
                                        <label for="name">Class Name:</label>
                                        <input type="text" name="name" class="form-control form-control-sm" required placeholder="Class Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="codename">Class Code Name:</label>
                                        <input type="text" class="form-control form-control-sm" name="codename" required placeholder="Class' Code Name">
                                    </div>
                                    <div class="col-6"> <input type="submit" style="margin-top: 31px;" class="btn btn-sm btn-primary" value="Add" name="addclass"></div>
                                </div>
                            </form>
                        </div>

                        <?php
                        if (isset($_POST['addclass'])) {
                            $department = $_POST['department'];
                            $name = $_POST['name'];
                            $codename = $_POST['codename'];
                            $cl = $_SESSION['username'] . "_" . $department;
                            $qq = "CREATE TABLE IF NOT EXISTS " . $cl . " ( `id` INT NOT NULL AUTO_INCREMENT  , `codename` VARCHAR(10) NOT NULL , `name` VARCHAR(40) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                            $q2 = "INSERT INTO " . $cl . "(codename, name) VALUES('" . $codename . "', '" . $name . "')";
                            if (mysqli_query($conn, $qq)) {
                                if (mysqli_query($conn, $q2)) {
                                    $sl = $_SESSION['username'] . "_" . $department . "_students";
                                    $sq = "SELECT collegeid FROM " . $sl;
                                    $result = mysqli_query($conn, $sq);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $sl = $_SESSION['username'] . "_" . $department . "_" . $row['collegeid'];
                                            $slq = "ALTER TABLE $sl ADD  ". $codename ." CHAR(1)";
                                            mysqli_query($conn, $slq);
                                        }
                                    }
                                    echo "Class Added Successfully";
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <script>
                                    function delete_it(e) {
                                        var r = confirm('Are you sure?');
                                        if (r == true) {
                                            location.href = "./delete.php?department=" + e.id + "&class=" + e.name;
                                            // console.log("./deleteclass.php?department=" + e.id + "&class=" + e.name);
                                        }
                                    }
                                </script>

                                <?php



                                if (isset($_SESSION['username'])) {
                                    if (isset($_GET['department'])) {
                                        $department = $_GET['department'];
                                        $cl = $_SESSION['username'] . "_" . $department;
                                        $q = "SELECT name, codename FROM " . $cl;
                                        $qq = mysqli_query($conn, $q);
                                        //         <td>Computer Science</td>
                                        // <td>Dr. Sunil Kumar Jangid</td>
                                        // <td><a href="#" class="btn btn-success btn-sm">Edit</a></td>
                                        if (mysqli_num_rows($qq) > 0) {
                                            while ($row = mysqli_fetch_assoc($qq)) {
                                                echo "<tr><td>" . $row['name'] . "</td>
                                                            <td>" . $row['codename'] . "</td>
                                                            <td><a name ='" . $row['codename'] . "' id='" . $_GET['department'] . "'  onclick='delete_it(this)' class='btn btn-danger btn-sm'>Delete</a></td></tr>";
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
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>