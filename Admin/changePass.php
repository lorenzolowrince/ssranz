<?php

error_reporting(0);

session_start();
require_once("../conn.php");

// Logout button will destroy the session, and 
// will unset the session variables 
// User will be headed to 'login.php' 
// after loggin out 
if (isset($_GET['logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location: ../index.php"); 
} 

if(isset($_POST['Submit']))
{
    
     $oldpassword = md5($_POST['opwd']);
     $user = @$_SESSION['username'];
     $newpassword = md5($_POST['npwd']);

    $sql = mysqli_query($conn,"SELECT password FROM tbladmin WHERE username='$user'") or die("Last error: {$conn->error}\n");
    
    $num = mysqli_fetch_array($sql);

    if($num>0)
    {
         $query = mysqli_query($conn,"UPDATE tbladmin SET password='$newpassword' WHERE username='$user'");
            $_SESSION['msg1']="Password Changed Successfully !!";
        }
        else    
        {
            $_SESSION['msg1']="Old Password not match !!";
        }
    }

if($_GET['id']) {
    $id = $_GET['id'];
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

        <!-- W3 SCHOOL REFERENCES -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <!-- W3 SCHOOL REFERENCES -->
        
        <title>SSRANZ - Change Password  </title>
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
                <div class="w3-bar-item"> EDIT PROFILE </div>
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
                    
                    <div class="w3-container">
                        <p style="color:red;"><?php echo $_SESSION['msg1'];?><?php echo $_SESSION['msg1']="";?></p>
                    </div>
                    
                    <div class="w3-card-4">
                        
                          <div class="w3-container w3-teal w3-small">
                            <h2>Change Password</h2>
                          </div>
                          <form name="chngpwd" action="" class="w3-container" method="post" onSubmit="return valid();">
                              
                                <br>
                                <p>      
                                    <label><b>Old Password</b></label>
                                    <input class="w3-input w3-border w3-sand" placeholder="********" name="opwd" id="opwd" type="password"  data-toggle="password" >
                                </p> 
                                <p>      
                                    <label><b>New Password</b></label>
                                    <input class="w3-input w3-border w3-sand" placeholder="********" name="npwd" id="npwd" type="password" data-toggle="password" >
                                </p>                                   
                                <p>      
                                    <label><b>Confirm Password</b></label>
                                    <input class="w3-input w3-border w3-sand" placeholder="********" name="cpwd" id="cpwd" type="password"  data-toggle="password" >
                                </p> 
                                
                                <div class="w3-container">
                                    <br>
                                    <a href="../Admin/index.php" class="w3-half w3-btn w3-black"> BACK </a> 
                                    <button class="w3-half w3-btn w3-green" type="submit" name="Submit">Change Password</button> 
                                </div>         
                              
                              <br>
                              
                          </form>
                        
                    </div>

                </div>
            </div>
            
        </div>
        
<script type="text/javascript">
	$("#password").password('toggle');
</script>

<script>
function backup() {
    var r = confirm("Do You Wish To Backup?");
    if (r == true ) {
        window.location = "http://localhost/oiSystem_W3/Export/index.php";
    }
}
</script>
<script>
function back() {
    var r = confirm("Do You Wish To Go Back?");
    if (r == true ) {
        window.location = "http://localhost/oiSystem_W3/Admin/index.php";
    }
}
</script>
<script type="text/javascript">
    function valid()
    {
        if(document.chngpwd.opwd.value=="")
            {
                alert("Old Password Filed is Empty !!");
                document.chngpwd.opwd.focus();
                return false;
            }
            else if(document.chngpwd.npwd.value=="")
            {
                alert("New Password Filed is Empty !!");
                document.chngpwd.npwd.focus();
                return false;
            }
            else if(document.chngpwd.cpwd.value=="")
            {
                alert("Confirm Password Filed is Empty !!");
                document.chngpwd.cpwd.focus();
                return false;
            }
            else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
            {
                alert("Password and Confirm Password Field do not match  !!");
                document.chngpwd.cpwd.focus();
                return false;
            }
        return true;
    }
</script>
        
    </body>
</html>
<?php
}
?>

