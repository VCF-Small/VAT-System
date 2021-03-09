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
    <title>Get Data - VAT CLIENT</title>
</head>

<body>
    <?php
    include("../conn.php");
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">VAT</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
    </nav>
    <div class="container">
        <div class="row" style="margin: 20px;">
            <script>
                window.onload = () => {
                    var username = document.getElementById("college").value;
                    $("#departments").load("loaddepartment.php?username=" + username);
                }
                $(document).ready(function() {
                    $('#college').change(function() {
                        var username = document.getElementById("college").value;
                        $("#departments").load("loaddepartment.php?username=" + username);
                    });
                    $("#start").click(function(e) {
                        e.preventDefault();
                        var deparment = document.getElementById("department").value;
                        $('#studentlist').load("./loadstudents.php?department=" + deparment);
                        $('#donenot').text(" ");
                        $('#submitbuttondiv').html('<input type="submit" class="btn btn-md btn-success" value="Submit Attendance" id="submit" name="submit">');
                        $('#camerasection').load("loadcamera.php");
                    });
                    $("#show").click(function(e){
                        e.preventDefault();
                        var username = document.getElementById("college").value;
                        var deparment = document.getElementById("departments").value;
                        var id = document.getElementById("id").value;
                        $("#data-col").load("getdata.php?username="+username+"&department="+deparment+"&id="+id);
                    });
                });
            </script>
            <div class="col-12 text-center">
                <form method="post">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-5 col-lg-3">
                            <label for="department">Department:</label>
                            <select name="department" class="form-control form-control-sm custom-select custom-select-sm" name="college" required id="college">
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
                        <div class="col-sm-12 col-md-5 col-lg-3">
                            <label for="department">Department:</label>
                            <select name="department" class="form-control form-control-sm custom-select custom-select-sm" required name="department" id="departments">


                            </select>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-3">
                            <label for="department">ID</label>
                            <input class="form-control form-control-sm" type="text" name="id" id="id">
                        </div>
                        <div class=" justify-content-center col-sm-2 col-xs-12 col-md-2 col-lg-2">
                            <input type="submit" class="btn btn-sm btn-primary" style="margin-top: 31px; float:left;" value="Show" id="show" name="show">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12" id="data-col">

            </div>
        </div>
        <form method="post">
            <p class="lead text-danger" id="donenot"></p>
            <!-- <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0 text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>

                    <tbody id="studentlist">
                        
                    </tbody>

                </table>
            </div> -->
            <div class="row justify-content-center" id="submitbuttondiv">
            </div>
        </form>
    </div>
</body>


</html>