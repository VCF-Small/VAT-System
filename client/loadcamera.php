<?php
    echo '<video id="preview" class= "embed-responsive" style="height:300px;"></video>
    <script>
        hidec();
        var scanner = new Instascan.Scanner(
            {
                video: document.getElementById("preview")
            }
        );
        scanner.addListener("scan", function(content) {
            //some action
            var studentID = JSON.parse(content);
            var department = document.getElementById("department").value;
            if(department == studentID.department){
                document.getElementById(studentID.id).checked = true;
                showc();
            }
            else{
                showce();
            }
        });
        function showce(){
            //NOT YOUR CARD CASE
            document.getElementById("confirm").innerHTML = "Not The Student Of This Branch";
            $("#confirm").removeClass("bg-info");
            $("#confirm").removeClass("bg-success");
            $("#confirm").addClass("bg-danger");
            setTimeout(hidec, 2000);
        }
        function showc(){
            document.getElementById("confirm").innerHTML = "Attendance Marked Successfully!";
            $("#confirm").removeClass("bg-info");
            $("#confirm").removeClass("bg-danger");
            $("#confirm").addClass("bg-success");
            setTimeout(hidec, 2000);
        }
        function hidec(){
            document.getElementById("confirm").innerHTML = "Show You QR Code";
            $("#confirm").removeClass("bg-success");
            $("#confirm").removeClass("bg-danger");
            $("#confirm").addClass("bg-info");
        }
        $(document).ready(function(){
            $("#submit").click(function(e){
                e.preventDefault();
                var students = document.getElementsByClassName("student");
                for(var i = 0; i < students.length; i++){
                    var department = document.getElementById("department").value;
                    var classname = document.getElementById("class_select").value;
                    var id = students[i].id;
                    var attend = document.getElementById(id).checked;
                    $("#donenot").removeClass("text-danger");
                    $("#donenot").addClass("text-success");
                    $("#donenot").load("./mark.php?department="+department+"&class="+classname+"&id="+id+"&attend="+attend);
                }
                setTimeout(function(){refresh();}, 1000);
            });
        });
        function refresh(){
            window.location.reload();
        }
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("No Cameras Exist");
            }
        });
    </script>';
