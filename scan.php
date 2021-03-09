<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan - VAT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=a0979a25f35731ac26dac1c170def768">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=9db842b3dc3336737559eb4abc0f1b3d">
</head>
<body>
    <?php
    $data = $_GET['a'];
    if($data == "false"){
        echo "Not";
    }
    else echo "yes";
if(isset($_POST['submit'])){
            // if(isset($_POST['check'])){
                
            //     echo "It is on";
            // }
            // else{
            //     echo "It is off";
            // }
        }
    ?>
    <form method="post">
        <input type="checkbox" name="check" id="">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>