<?php
    session_start();
    include("conn.php");
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
                    echo "
                                <option value='" . $row['codename'] . "'>" . $row['codename'] . "</option>
                                ";
                }
            }
        }
    } else {
        echo '<script type="text/javascript">location.href = "./login.php";</script>';
    }


?>