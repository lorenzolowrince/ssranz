<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once '../conn.php';

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
        
        <!-- W3 SCHOOL REFERENCES -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <!-- W3 SCHOOL REFERENCES -->
        
        <title>SSRANZ - Restore Data</title>
    </head>
    <body>
        
        <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
          <a href="../Menu.php" class="w3-button w3-bar-item w3-teal w3-xlarge"><i class="fa fa-home"></i> HOME</a>
          <a href="../Admin/index.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>
          <a href="../Admin/adminList.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-group" aria-hidden="true"></i> ADMINS</a> 
          <a href="../Members/Register.php" class="w3-bar-item w3-button">Registration</a>
          <a href="../Members/index.php" class="w3-bar-item w3-button">Members</a>
          <a href="../StatisticMenu/index.php" class="w3-bar-item w3-button">Statistics Menu</a>
          <a href="../Diary/index.php" class="w3-bar-item w3-button">Diary</a>
          <a href="../Archived/index.php" class="w3-bar-item w3-button">Archive</a>
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
          <a href="index.php" class="w3-bar-item w3-button">
              Restore Data
            <p class="w3-red w3-small"> 
                        Last Data Restore Done:- 
                        <?php

                            $sql = "SELECT * FROM tbllastknownrestore";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo  $row["date"]. "  " . $row["time"] ;
                            }
                        } else {
                            echo "0 results";
                        }

                        ?> 
                </p>
            </a>
             <?php  if (isset($_SESSION['username'])) : ?> 
                <a href="../index.php?logout='1'" class="w3-large w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LOG OUT </a>
            <?php endif ?> 

        </div>
        <!-- Sidebar -->
        
        <div style="margin-left:15%">
            
            <div class="w3-bar w3-teal">
                <div class="w3-bar-item"> RESTORE DATA  </div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        echo date('d/m/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
            </div>  
            
            <br>
            
            <form method='post' action='import.php' onclick="return confirm('Do You Wish To Restore?');"> 
                <div class="w3-row w3-container w3-padding">
                    <input class="w3-button w3-black" type='submit' value='Restore' name='Import'>
                </div>

                <div class="w3-row">
                    <div class="w3-container w3-padding w3-center">
                        <h2> MEMBERS </h2>
                        <table class="w3-table-all">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date of Registration</th>
                                <th>Membership Number</th>
                                <th>Email</th>
                            </tr>
                        <?php
                            include '../conn.php';
                            $no = 1;
                            $data = mysqli_query($conn,"SELECT * FROM tblregister");

                            while($d = mysqli_fetch_array($data)){
                                ?>
                                <tr class="item">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['name']; ?></td>
                                    <td><?php echo $d['joinedSince']; ?></td>
                                    <td><?php echo $d['regNum']; ?></td>
                                    <td><?php echo $d['email']; ?> </td>
                                </tr>
                                <?php 

                            }
                            ?>
                        </table>
                    </div>
                </div>
                
                <br>
                
                <div class="w3-row">
                    <div class="w3-container w3-padding w3-center">
                        <h2> DIARY </h2>
                        <table class="w3-table-all">
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Label</th>
                                <th>Submitted Date</th>
                                <th>Updated Date</th>
                            </tr>
                        <?php
                            include '../conn.php';
                            $no = 1;
                            $data = mysqli_query($conn,"SELECT * FROM tbldiary");

                            while($d = mysqli_fetch_array($data)){
                                ?>
                                <tr class="item">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['title']; ?></td>
                                    <td><?php echo $d['label']; ?></td>
                                    <td><?php echo $d['submitDate']; ?></td>
                                    <td><?php echo $d['updateDate']; ?> </td>
                                </tr>
                                <?php 

                            }
                            ?>
                        </table>
                    </div>
                </div>                
                
                <div class="w3-row">
                    <div class="w3-container w3-padding w3-center">
                        <h2> ARCHIVED </h2>
                        <table class="w3-table-all">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Date of Registration</th>
                                <th>Membership Number</th>
                                <th>Email</th>
                            </tr>
                        <?php
                            include '../conn.php';
                            $no = 1;
                            $data = mysqli_query($conn,"SELECT * FROM tblarchived");

                            while($d = mysqli_fetch_array($data)){
                                ?>
                                <tr class="item">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['name']; ?></td>
                                    <td><?php echo $d['joinedSince']; ?></td>
                                    <td><?php echo $d['regNum']; ?></td>
                                    <td><?php echo $d['email']; ?> </td>
                                </tr>
                                <?php 

                            }
                            ?>
                        </table>
                    </div>
                </div>
            </form>
                
        </div>
        
         <br>
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

