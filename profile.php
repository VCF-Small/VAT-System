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
            <h3 class="text-dark mb-4">Profile</h3>
            <div class="row mb-3">
                <div class="col-lg-8">
                    <!-- <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">Student ID</p>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $data = array();
                                    $college = "";
                                    $department = "";
                                    $id = "";
                                    if (!empty($_GET)) {
                                        $college = $_GET['college'];
                                        $department = $_GET['department'];
                                        $id = $_GET['id'];
                                        $d = $college . "_" . $department . "_students";
                                        $q = "SELECT name, collegeid, age, gender, address FROM " . $d . " WHERE collegeid=" . $id;
                                        $result = mysqli_query($conn, $q);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            array_push($data, $row['name'], $row['collegeid'], $row['age'], $row['gender'], $row['address']);
                                        }
                                    }
                                    ?>
                                    <div id="student_id">
                                        <div class="form-row">
                                            <div class="col">
                                                <p>Id: <?php echo " $data[1]" ?></p>
                                                <p>Name: <?php echo " $data[0]" ?></p>
                                                <p>Age: <?php echo " $data[2]" ?></p>
                                                <p>Gender: <?php echo " $data[3]" ?></p>
                                                <p>Address: <?php echo " $data[4]" ?></p>
                                            </div>
                                            <div class="col">
                                                <?php
                                                echo '<img src="' . "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={%22college%22:%22$college%22,%22department%22:%22$department%22,%22id%22:%22$id%22}" . '"' . " title='Student QR' />";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="downloadid" class="btn btn-small btn-primary">Download</button>
                                    <script>
                                        var d = document.getElementById("downloadid");
                                        d.addEventListener("click", function(e) {
                                            var div = document.getElementById("student_id");
                                            var opt = {
                                                margin: [20, 20, 20, 20],
                                                filename: `student_id.pdf`,
                                                image: {
                                                    type: 'jpg',
                                                    quality: 0.98
                                                },
                                                html2canvas: {
                                                    scale: 2,
                                                    useCORS: true
                                                },
                                                jsPDF: {
                                                    unit: 'mm',
                                                    format: 'letter',
                                                    orientation: 'portrait'
                                                }
                                            };
                                            html2pdf().from(div).set(opt).save();
                                        });
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/dogs/image2.jpeg?h=a0a7d00bcd8e4f84f4d8ce636a8f94d4" width="160" height="160">
                                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div>
                                </div>
                            </div> -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="text-primary font-weight-bold m-0">Attendance Percent</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $sl = $college . "_" . $department . "_" . $id;
                            $cl = $college . "_" . $department;
                            $q = "SELECT codename FROM ".$cl;
                            $result1 = mysqli_query($conn, $q);
                            while($row = mysqli_fetch_assoc($result1)){
                                
                                $q2 = "SELECT ".$row['codename']." FROM ".$sl." WHERE ".$row['codename']."='P'";
                                $q3 =  "SELECT ".$row['codename']." FROM ".$sl;
                                $p = mysqli_num_rows(mysqli_query($conn, $q2));
                                $total = mysqli_num_rows(mysqli_query($conn, $q3));
                                if($p != 0 && $total != 0){
                                    echo '<h4 class="small font-weight-bold">'.$row['codename'].'<span class="float-right">'.($p/$total * 100).'%</span></h4>';
                                    echo '<div class="progress progress-sm mb-3">
                                <div class="progress-bar bg-info" aria-valuenow="'.($p/$total * 100).'" aria-valuemin="0" aria-valuemax="100" style="width: '.($p/$total * 100).'%;"><span class="sr-only">'.($p/$total * 100).'%</span></div>
                            </div>';
                                }
                                else{
                                    echo '<h4 class="small font-weight-bold">'.$row['codename'].'<span class="float-right">0%</span></h4>';
                                    echo '<div class="progress progress-sm mb-3">
                                    <div class="progress-bar bg-info" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><span class="sr-only">0%</span></div>
                                </div>';
                                }
                            }
                            ?>
                            
                            

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</body>

</html>