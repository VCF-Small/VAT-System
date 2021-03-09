<?php
include("../conn.php");

if (isset($_GET['username']) && isset($_GET['department']) && isset($_GET['id'])) {
    $username = $_GET['username'];
    $sl = $username . "_" . $_GET['department'] . "_students";
    $cl = $username . "_" . $_GET['department'] . "_" . $_GET['id'];
    $q = "SELECT name FROM " . $sl;
    $qq = mysqli_query($conn, $q);


    echo '<br><div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">Student ID</p>
    </div>
    <div class="card-body">';
    $data = array();
    $college = "";
    $department = "";
    $id = "";
        $username = $_GET['username'];
        $department = $_GET['department'];
        $id = $_GET['id'];
        $d = $college . "_" . $department . "_students";
        $q = "SELECT id, name, collegeid, age, gender, address FROM " . $sl . " WHERE collegeid=" . $id;
        $result = mysqli_query($conn, $q);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row['name'], $row['collegeid'], $row['age'], $row['gender'], $row['address']);
        }

    echo '<div id="student_id">
            <div class="form-row">
                <div class="col">
                    <p>Id:';
    echo $data[1] . "</p>";
    echo "<p>Name:" . $data[0] . "</p>";
    echo "<p>Age:" . $data[2] . "</p>";
    echo "<p>Gender:" . $data[3] . "</p>";
    echo '<p>Address:' . $data[4] . '</p>
                </div>
                <div class="col">';

    echo '<img src="' . "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={%22college%22:%22$username%22,%22department%22:%22$department%22,%22id%22:%22$id%22}" . '"' . " title='Student QR' />";

    echo '</div>
            </div>
        </div>
        <script>
            var d = document.getElementById("downloadid");
            d.addEventListener("click", function(e) {
                var div = document.getElementById("student_id");
                var opt = {
                    margin: [20, 20, 20, 20],
                    filename: `student_id.pdf`,
                    image: {
                        type: "jpg",
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "letter",
                        orientation: "portrait"
                    }
                };
                html2pdf().from(div).set(opt).save();
            });
        </script>
    </div>
</div>';

echo '<div class="">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-primary font-weight-bold m-0">Attendance Percent</h6>
    </div>
    <div class="card-body">';
        $sl = $username . "_" . $department . "_" . $id;
        $cl = $username . "_" . $department;
        $q = "SELECT codename FROM ".$cl;
        $result1 = mysqli_query($conn, $q);
        while($row = mysqli_fetch_assoc($result1)){
            
            $q2 = "SELECT ".$row['codename']." FROM ".$sl." WHERE ".$row['codename']."='P'";
            $q3 =  "SELECT ".$row['codename']." FROM ".$sl;
            $p = mysqli_num_rows(mysqli_query($conn, $q2));
            $total = mysqli_num_rows(mysqli_query($conn, $q3));
            if($p != 0 && $total != 0){
                echo '<h4 class="small font-weight-bold">'.$row['codename'].'<span class="float-right">'.(int)($p/$total * 100).'%</span></h4>';
                echo '<div class="progress progress-sm mb-3">
            <div class="progress-bar bg-info" aria-valuenow="'.(int)($p/$total * 100).'" aria-valuemin="0" aria-valuemax="100" style="width: '.(int)($p/$total * 100).'%;"><span class="sr-only">'.(int)($p/$total * 100).'%</span></div>
        </div>';
            }
            else{
                echo '<h4 class="small font-weight-bold">'.$row['codename'].'<span class="float-right">0%</span></h4>';
                echo '<div class="progress progress-sm mb-3">
                <div class="progress-bar bg-info" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><span class="sr-only">0%</span></div>
            </div>';
            }
        }
   echo ' </div>
</div>
</div>';
} else {
    echo "Fill All The Details";
}

?>