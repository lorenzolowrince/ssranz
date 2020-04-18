<?php
  
require_once("conn.php");
   
// Starting the session, necessary 
// for using session variables 
session_start(); 

// Fetch Admin Info
$query = "SELECT * FROM tbladmin WHERE username = '{$_SESSION['username']}' ";
    $run_query = mysqli_query($conn, $query);
    if(mysqli_num_rows($run_query) == 1){
        while($result = mysqli_fetch_assoc($run_query)){
                $user_name = $result['name'];
            }
        }

// If the session variable is empty, this  
// means the user is yet to login 
// User will be sent to 'login.php' page 
// to allow the user to login 
if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location: index.php'); 
} 

// Logout button will destroy the session, and 
// will unset the session variables 
// User will be headed to 'login.php' 
// after loggin out 
if (isset($_GET['logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location: index.php"); 
} 
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/mainCSS.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <title>SSRANZ - Menu</title>
    </head>
    <body>
        
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
            
            <button class="w3-bar-item w3-button w3-large w3-teal w3-center" onclick="w3_close()">CLOSE &times;</button>   
            <?php  if (isset($_SESSION['username'])) : ?> 
            <a href="Admin/index.php?=<?php echo $_SESSION['username'];    ?>" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>   
            <?php endif ?>
            <a href="Admin/adminList.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-group" aria-hidden="true"></i> ADMINS</a>  
            <div class="w3-container w3-padding w3-red">
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
            </div>
            
            <br>
            
            <div class="w3-container w3-padding w3-red">
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
            </div>
            
            
        </div>
        
        <div class="w3-bar w3-teal">
            <button id="openNav" class="w3-bar-item w3-button w3-teal" onclick="w3_open()">&#9776; NOTICE </button>
             <?php  if (isset($_SESSION['username'])) : ?> 
                <a href="index.php?logout='1'" class="w3-bar-item w3-button w3-right">LOG OUT <i class="fa fa-sign-out"></i></a>
                <a class="w3-bar-item w3-right">WELCOME: <strong> <?php echo $user_name; ?> </strong> </a>
            <?php endif ?> 
        </div>    
        
        <br>
        
        <!-- Upper Section -->
        <div class="w3-row">
                    <!-- Creating notification when the 
                            user logs in -->
                    <!-- Accessible only to the users that 
                            have logged in already -->
                    <?php if (isset($_SESSION['success'])) : ?> 
                        <div class="error success" > 
                            <h3> 
                                <?php
                                    echo $_SESSION['success'];  
                                    unset($_SESSION['success']); 
                                ?> 
                            </h3> 
                        </div> 
                    <?php endif ?> 
        </div>
        <div class="w3-row">
            <div class="w3-third">
                &nbsp;
            </div>      
            <div class="w3-third w3-container w3-padding w3-center">
                <div class="w3-card-4"  >
                    <img src="img/ssranz.jpg" alt="SSRANZ" width="80%">
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
        <!-- Upper Section -->
             
        <br>
        
        <div class="w3-row w3-container w3-center"> 
            <div class="w3-bar w3-black">
                <a href="Members/Register.php" class="w3-bar-item w3-button w3-mobile">Registration</a>
                <a href="Members/index.php" class="w3-bar-item w3-button w3-mobile">Members</a>
                <a href="StatisticMenu/index.php" class="w3-bar-item w3-button w3-mobile">Statistics</a>
                <a href="Diary/index.php" class="w3-bar-item w3-button w3-mobile">Diary</a>
                <a href="Archived/index.php" class="w3-bar-item w3-button w3-mobile">Archive</a>
                <a onclick="backup()" class="w3-bar-item w3-button w3-mobile">Backup Data</a>  
                <a href="Import/index.php" class="w3-bar-item w3-button w3-mobile">Restore Data</a>
            </div>
        </div>
        
        <br>

<script>
function backup() {
    var backup;
    var r = confirm("Do You Wish To Backup?");
    if (r == true ) {
        window.location = "http://localhost:81/ssranz/Export/index.php";
    }
}
</script>
        
<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
         
    </body>
</html>