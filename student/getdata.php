<?php
include("../conn.php");

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $cl = $username . "_departments";
    $q = "SELECT codename FROM " . $cl;
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

?>