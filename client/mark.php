<?php
    session_start();
    include("conn.php");
    $department = $_GET['department'];
    $class = $_GET['class'];
    $id = $_GET['id'];
    $attend  = $_GET['attend'];
    if($attend == "true"){
        $attend = "P";
    }
    else{
        $attend = "A";
    }
    $sl = $_SESSION['username']."_".$department."_".$id;
    $q1 = "SELECT date, ".$class." FROM ".$sl." ORDER BY id DESC LIMIT 1;";
    $q2 = "INSERT INTO " .$sl."(date, ".$class.") VALUES('".date("d-m-Y")."', '".$attend."')"; 
    
    $date = "";
    $class_data = "";
    $result1 = mysqli_query($conn, $q1);
    while($row = mysqli_fetch_assoc($result1)){
        $date = $row['date'];
        $class_data = $row[$class];
    }
    $q3 = "UPDATE ".$sl." SET ".$class."='".$attend."' WHERE date = '".$date."'";
    if($date == date("d-m-Y")){
        if($class_data != ""){
            echo '<script>
            $("#donenot").removeClass("text-success");
            $("#donenot").addClass("text-danger");
            </script>';
            echo "Already Submitted!";
        }
        else{
                if(mysqli_query($conn, $q3)){
                    echo "Successfully Submitted The Attendence!";
                }
                else{
                    echo mysqli_error($conn);
                }
        }
    }
    else{

                if(mysqli_query($conn, $q2)){
                    echo "Successfully Submitted The Attendence!";
                }
                else{
                    echo mysqli_error($conn);
                }

    }
