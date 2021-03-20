<?php
    session_start();
    include("conn.php");
    $username = $_SESSION["username"];
    if(isset($_SESSION['username'])){
        if(!empty($_GET)){
            if(isset($_GET['department']) && isset($_GET['id'])){
                $si = $_SESSION['username'] . "_" . $_GET['department'] ."_students";
                $sq = "DELETE FROM ".$si." where collegeid = '".$_GET['id']."'";
                $sl = $_SESSION['username'] . "_" . $_GET['department'] . "_" . $_GET['id'];
                $slq = "DROP Table IF EXISTS ".$sl;
                mysqli_query($conn, $slq);
                mysqli_query($conn, $sq);
                // echo $slq;
                echo '<script>location.href = "students.php"</script>';
            }
            
            else if(isset($_GET['department']) && isset($_GET['class'])){
                $cl = $_SESSION['username'] . "_" . $_GET['department'];
                $cq = "DELETE From ".$cl." where codename = '".$_GET['class']."'";
                $si = $_SESSION['username'] . "_" . $_GET['department'] ."_students";
                $sq = "SELECT collegeid FROM ".$si;
                $result = mysqli_query($conn, $sq);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sl = $_SESSION['username'] . "_" . $_GET['department'] . "_" . $row['collegeid'];
                        $slq = "ALTER TABLE $sl DROP COLUMN ". $_GET['class'];

                        mysqli_query($conn, $slq);
                    }
                }
                mysqli_query($conn, $cq);
                echo '<script>location.href = "classes.php"</script>';


            }
            else if(isset($_GET['department'])){
                $dl = $_SESSION['username'] . "_departments";
                $cl = $_SESSION['username'] . "_" . $_GET['department'];
                $cq = "DROP Table IF EXISTS ".$cl;
                $si = $_SESSION['username'] . "_" . $_GET['department'] ."_students";
                $siq = "DROP Table IF EXISTS ".$si;
                $sq = "SELECT collegeid FROM ".$si;
                $result = mysqli_query($conn, $sq);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sl = $_SESSION['username'] . "_" . $_GET['department'] . "_" . $row['collegeid'];
                        $slq = "DROP Table IF EXISTS ".$sl;
                        mysqli_query($conn, $slq);
                    }
                }
                $dq = "DELETE FROM ".$dl." where codename = '".$_GET['department']."'";
                mysqli_query($conn, $siq);
                mysqli_query($conn, $cq);
                mysqli_query($conn, $dq);
                echo '<script>location.href = "departments.php"</script>';
            }
            
            else{
                echo "Give A Correct Input";
            }
        }
        else{
            echo "No Input Found";
        }
    }
    else{
        echo "Needs Admin Permissions";
    }


?>