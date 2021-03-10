<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
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
            <h3 class="text-dark mb-4">Departments</h3>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Deparment Information</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Add Department</p>
                            <form method="post">
                                <div class="row">

                                    <div class="col-md-6 col-sm-12 ">
                                        <label for="name">Department Name :</label>
                                        <input type="text" class="form-control form-control-sm" name="name" required>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="codename" required>Department Code Name:</label>
                                        <input type="text" class="form-control form-control-sm" name="codename" placeholder="eg: CS/EE/ME/CE" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <label for="hodname">Hod Name:</label>
                                        <input type="text" class="form-control form-control-sm" name="hodname" required>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <input type="submit" style="margin-top: 32px;" class="btn btn-sm btn-primary" value="Add" name="submit">
                                    </div>


                                </div>
                            </form>

                            <?php

                            require("conn.php");
                            $dl = $_SESSION['username'] . "_departments";

                            if (!isset($_SESSION['username'])) {
                                header('location:./login.php');
                            }

                            if (isset($_POST['submit'])) {
                                $name = $_POST['name'];
                                $codename = $_POST['codename'];
                                $hodname = $_POST['hodname'];
                                $hodname = trim($hodname);
                                $name = trim($name);
                                $codename = trim($codename);
                                if ($name != "") {
                                    $q = "INSERT INTO " . $dl . "(name, codename, hodname) Values('" . $name . "', '" . $codename . "', '" . $hodname . "')";
                                    $q1 = "SELECT name from " . $dl . " WHERE name = '" . $name . "' OR codename = '" . $codename . "'";

                                    if (mysqli_num_rows(mysqli_query($conn, $q1)) == 0) {
                                        if (mysqli_query($conn, $q)) {
                                            $cl = $_SESSION['username'] . "_" . $codename;
                                            $qq = "CREATE TABLE IF NOT EXISTS " . $cl . " ( `id` INT NOT NULL AUTO_INCREMENT  , `codename` VARCHAR(10) NOT NULL , `name` VARCHAR(40) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                                            $qq2 = "CREATE TABLE IF NOT EXISTS " . $cl . "_students ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(40) NOT NULL , `collegeid` VARCHAR(20) NOT NULL , `age` INT(4) NOT NULL , `gender` VARCHAR(10) NOT NULL , `address` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
                                            if (mysqli_query($conn, $qq)) {
                                                if (mysqli_query($conn, $qq2)) {
                                                    echo "<p style='color:green'>Department Was Added Successfully</p>";
                                                }
                                            }
                                        } else {
                                            echo "error" . mysqli_error($conn);
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code Name</th>
                                    <th>HOD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <script>
                                    function delete_it(e){
                                        var r = confirm('Are you sure?');
                                                if(r == true)
                                                {
                                                    location.href = "./delete.php?department=" + e.name;
                                                }
                                        
                                        // var db = document.getElementsByClassName("delete_btn");
                                        // for (var i = 0; i< db.length; i++) {
                                        //     db[i].addEventListener("click", function(sender){
                                                
                                        //         var r = confirm('Are you sure?');
                                        //         if(r == true)
                                        //         {
                                                    
                                        //         }
                                        //     })
                                        // }
                                    }
                                </script>
                                <tr>
                                    <?php
                                    if (isset($_SESSION['username'])) {
                                        $dl = $_SESSION['username'] . "_departments";
                                        $q = "SELECT name,codename, hodname FROM " . $dl;
                                        $qq = mysqli_query($conn, $q);
                                        //         <td>Computer Science</td>
                                        // <td>Dr. Sunil Kumar Jangid</td>
                                        // <td><a href="#" class="btn btn-success btn-sm">Edit</a></td>
                                        if (mysqli_num_rows($qq) > 0) {
                                            while ($row = mysqli_fetch_assoc($qq)) {
                                                echo "<tr><td>" . $row['name'] . "</td>
                                                            <td>" . $row['codename'] . "</td>
                                                            <td>" . $row['hodname'] . "</td>
                                                            <td><a name='" . $row['codename'] . "' onclick='delete_it(this)' class='btn btn-danger btn-sm delete_btn'>Delete</a></td></tr>";
                                            }
                                        }
                                    } else {
                                        header("location:login.php");
                                    }
                                    ?>

                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

</body>

</html>