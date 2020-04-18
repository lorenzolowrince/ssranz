<?php

require_once("../conn.php");
include("../server.php");
    if(empty($_SESSION['username'])){
        header('location: ../index.php');
    }
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
        
        <title>SSRANZ - Admin Profile </title>
    </head>
    <body>
        
        <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
          <a href="../Menu.php" class="w3-button w3-bar-item w3-teal w3-xlarge"><i class="fa fa-home"></i> HOME</a>
          <a href="index.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>
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
                <div class="w3-bar-item"> <?php  ?> PROFILE </div>
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
                <div class="w3-container">
                    
                    <div class="w3-card-4">
                            <?php   
                                $sql="SELECT * FROM tbladmin WHERE username = '{$_SESSION['username']}' ";
                                    $query=$conn->query($sql);
                                    while($row=$query->fetch_array()){
                              ?>
                          <div class="w3-container w3-teal w3-small">
                            <h2><?php echo $row['name']; ?>'s Profile</h2>
                          </div>
                          <div class="w3-container">

                                <p>      
                                    <label><b>Name</b></label>
                                    <input class="w3-input w3-border w3-sand" value="<?php echo $row['name']; ?>"  name="name" type="text" disabled >
                                </p>
                                <p>      
                                    <label><b>Username</b></label>
                                    <input class="w3-input w3-border w3-sand" value="<?php echo $row['username']; ?>"  name="username" type="text" disabled>
                                </p>                                   
                                <p>      
                                    <label><b>Email</b></label>
                                    <input class="w3-input w3-border w3-sand" value="<?php echo $row['email']; ?>"  name="email" type="email" disabled>
                                </p>                              
                                <p>      
                                    <label><b>Contact</b></label>
                                    <input class="w3-input w3-border w3-sand" value="<?php echo $row['contact']; ?>"  name="contact" type="text" disabled >
                                </p>                                                                        
                                <div class="w3-container">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>"> <button class="w3-half w3-btn w3-black" type='button'>EDIT</button></a>   
                                    <a href="changePass.php?id=<?php echo $row['id']; ?>"> <button class="w3-half w3-btn w3-green" type='button'>CHANGE PASSWORD</button></a>   
                                </div>
                              <?php
                                    }
                              ?>
                                <br>
                          </div>    
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

