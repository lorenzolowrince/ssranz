<?php
    require_once '../../conn.php';
    date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
// Logout button will destroy the session, and 
// will unset the session variables 
// User will be headed to 'login.php' 
// after loggin out 
if (isset($_GET['logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location: ../index.php"); 
} 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
        
        <title>SSRANZ - Member Registration Graph</title>
    </head>
    <body>
    
        <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
          <a href="../../Menu.php" class="w3-button w3-bar-item w3-teal w3-xlarge"><i class="fa fa-home"></i> HOME</a>
          <a href="../../Admin/index.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>
          <a href="../../Admin/adminList.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-group" aria-hidden="true"></i> ADMINS</a> 
            <a href="../../Members/Register.php" class="w3-bar-item w3-button">Registration</a>
            <a href="../../Members/index.php" class="w3-bar-item w3-button">Members</a>
            <a href="../index.php" class="w3-bar-item w3-button">Statistics Menu</a>
            <a href="../../Diary/index.php" class="w3-bar-item w3-button">Diary</a>
            <a href="../../Archived/index.php" class="w3-bar-item w3-button">Archive</a>
            <a onclick="backup()" class="w3-bar-item w3-button">
              Backup Data
            <p class="w3-red w3-small"> 
                        Last Data Backup Done:- 
                        <?php

                            $sql = "SELECT * FROM tbllastknownbackup";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo  $row["date"]. "  " . $row["time"];
                            }
                        } else {
                            echo "0 results";
                        }

                        ?> 
                </p>
                
            </a>
            <a href="../../Import/index.php" class="w3-bar-item w3-button">
              Restore Data
            <p class="w3-red w3-small"> 
                        Last Data Restore Done:- 
                        <?php

                            $sql = "SELECT * FROM tbllastknownrestore";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo  $row["date"]. "  " . $row["time"];
                            }
                        } else {
                            echo "0 results";
                        }

                        ?> 
                </p>
            </a>
             <?php  if (isset($_SESSION['username'])) : ?> 
                <a href="../../index.php?logout='1'" class="w3-large w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LOG OUT </a>
            <?php endif ?> 
        </div>
        <!-- Sidebar -->
        
        <div style="margin-left:15%">
            
            <div class="w3-bar w3-teal">
                <div class="w3-bar-item">MEMBER REGISTRATION PER YEAR GRAPH</div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('d/m/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
            </div>     

            <br>

                <div class="w3-center w3-container">
                    <canvas id="myChart" width="50%" height="20%"></canvas>
                    <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',
                        
                        // The data for our dataset
                        data: {
                            labels: [<?php  
                                
                            $year = date('Y');
                                
                            $result = mysqli_query($conn, "SELECT MIN(year(joinedSince)) AS minYear FROM tblregister"); 
                            $row = mysqli_fetch_assoc($result); 
                            $minYear = $row['minYear'];

                            $result = mysqli_query($conn, "SELECT MAX(year(joinedSince)) AS maxYear FROM tblregister");
                            $row = mysqli_fetch_assoc($result);
                            $maxYear = $row['maxYear'];  
                                
                            for($year = $minYear; $year <= $maxYear; $year++){
                                
                            echo $year;
                            echo ',';
                            }        
                                     ?>],
                            datasets: [{
                                label: 'TOTAL MEMBER REGISTRATION IN A YEAR',
                                borderColor: 'teal',
                                pointBackgroundColor: 'black',
                                data: [<?php    
                                
                                $total = array();
                                    
                                for ($year = $minYear; $year <= $maxYear; $year++){
                                
                                $sql="SELECT *, count(id) AS total FROM tblregister WHERE year(joinedSince)='$year'";
                                
                                $query = $conn->query($sql);
                                $row = mysqli_fetch_assoc($query);
                                    
                                $totalReg = $row['total'];                                
                                    
                                $sql="SELECT *, count(id) AS total FROM tblarchived WHERE year(joinedSince)='$year'";
                                
                                $query = $conn->query($sql);
                                $row = mysqli_fetch_assoc($query);
                                    
                                $totalArc = $row['total'];
                                    
                                echo $total[] = $totalReg + $totalArc;
                                echo ',';
                                    }
                                    
                                    ?>]
                            }]
                        },

                        // Configuration options go here
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        stepSize: 2
                                    }
                                }]
                            }
                        }
                    });   
                    </script>
                    
                </div> 
            
            <br>
            
        </div>
<script>
function backup() {
    var r = confirm("Do You Wish To Backup?");
    if (r == true ) {
        window.location = "http://localhost:81/ssranz/Export/index.php";
    }
}
</script>
    </body>
</html>


