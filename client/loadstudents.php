<?php
session_start();
include("conn.php");
if (isset($_SESSION['username'])) {
    if (isset($_GET['department'])) {
        $department = $_GET['department'];
        $cl = $_SESSION['username'] . "_" . $department . "_students";
        $q = "SELECT name,collegeid FROM " . $cl;
        $qq = mysqli_query($conn, $q);
        //         <td>Computer Science</td>
        // <td>Dr. Sunil Kumar Jangid</td>
        // <td><a href="#" class="btn btn-success btn-sm">Edit</a></td>
        if (mysqli_num_rows($qq) > 0) {
            while ($row = mysqli_fetch_assoc($qq)) {
                echo "<tr><td><p>" . $row['name'] . "</p></td>
                                                    <td>" . $row['collegeid'] . "</td>
                                                    <td><input class='student form-check-input form-check-input-success' type='checkbox' name='" . $row['collegeid'] . "' id='" . $row['collegeid'] . "'></td>
                                                    </tr>";
            }
        }
} 
} else {
    echo '<script type="text/javascript">location.href = "./login.php";</script>';
}
