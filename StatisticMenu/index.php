<?php

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
        <link rel="stylesheet" href="../css/mainCSS.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Statistic Menu</title>
    </head>
    <body>
        
        <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
          <a href="../Menu.php" class="w3-button w3-bar-item w3-teal w3-xlarge"><i class="fa fa-home"></i> HOME</a>
          <a href="../Admin/index.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>
          <a href="../Admin/adminList.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-group" aria-hidden="true"></i> ADMINS</a> 
          <a href="../Members/Register.php" class="w3-bar-item w3-button">Registration</a>
          <a href="../Members/index.php" class="w3-bar-item w3-button">Members</a>
          <a href="index.php" class="w3-bar-item w3-button">Statistics Menu</a>
          <a href="../Diary/index.php" class="w3-bar-item w3-button">Diary</a>
          <a href="../Archived/index.php" class="w3-bar-item w3-button">Archive</a>
          <a onclick="backup()" class="w3-bar-item w3-button">
              Backup Data
            <p class="w3-red w3-small"> 
                        Last Data Backup Done:- 
                        <?php

                            require_once '../conn.php';

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
          <a href="../Import/index.php" class="w3-bar-item w3-button">
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
                <a href="../index.php?logout='1'" class="w3-large w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LOG OUT </a>
            <?php endif ?> 
        </div>
        <!-- Sidebar -->
        
        <div style="margin-left:15%">
            
            <div class="w3-bar w3-teal">
                <div class="w3-bar-item">STATISTIC MENU</div>
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

            <div class="w3-row">
                <div class="w3-third">
                    &nbsp;
                </div>      
                <div class="w3-third w3-container w3-padding w3-center">
                    <div class="w3-card-4"  >
                        <img src="../img/ssranz.jpg" alt="Logo" width="90%">
                            <div class="w3-container w3-center">                                
                            </div>
                    </div>     
                </div>    
                <div class="w3-third">
                    &nbsp;
                </div>
            </div> 


            <div class="w3-row">
                <div class="w3-container w3-padding w3-center">                				
				<h2><strong> SSRANZ INFORMATION AND COMMUNICATION  </strong></h2>                    
                </div>
            </div>

            <br>

        <div class="w3-row">
            <div class="w3-container w3-center"> 
                <div class="w3-bar w3-black"> 
                    <div class="w3-dropdown-hover">
                        <button class="w3-button w3-black">Member Registration <i class="fa fa-caret-down"></i></button>
                        <div class="w3-dropdown-content w3-bar-block w3-border">
                            <a href="memberReg/month.php" class="w3-bar-item w3-button">Per Month in a year</a>
                            <a href="memberReg/year.php" class="w3-bar-item w3-button">Per Year</a>
                        </div>
                    </div>
                        <!-- <a href="#financial" class="w3-bar-item w3-button w3-mobile"> Financial</a> -->
                    </div>
                </div>
            </div>
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

