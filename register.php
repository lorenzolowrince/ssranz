<?php 

include('server.php') 

?> 
<!DOCTYPE html> 
<html> 
<head> 
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title> 
		SSRANZ - Admin Register
	</title> 
	<link rel="stylesheet" type="text/css" href="style.css"> 
</head> 

<body class="w3-gray">
    
    <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
          <a href="Menu.php" class="w3-button w3-bar-item w3-teal w3-xlarge"><i class="fa fa-home"></i> HOME</a>
          <a href="Admin/index.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a>
          <a href="Admin/adminList.php" class="w3-button w3-bar-item w3-large"><i class="fa fa-group" aria-hidden="true"></i> ADMINS</a> 
          <a href="Members/Register.php" class="w3-bar-item w3-button">Registration</a>
          <a href="Members/index.php" class="w3-bar-item w3-button">Members</a>
          <a href="StatisticMenu/index.php" class="w3-bar-item w3-button">Statistics Menu</a>
          <a href="Diary/index.php" class="w3-bar-item w3-button">Diary</a>
          <a href="Archived/index.php" class="w3-bar-item w3-button">Archive</a>
          <a onclick="backup()" class="w3-bar-item w3-button ">
              Backup Data
            <p class="w3-red w3-small"> 
                        Last Data Backup Done:- 
                        <?php

                            require_once 'conn.php';

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
          <a href="Import/index.php" class="w3-bar-item w3-button">
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
        </div>
        <!-- Sidebar -->
    
    <div style="margin-left:15%">
         <div class="w3-bar w3-teal">
                <div class="w3-bar-item">ADMIN REGISTRATION</div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('m/d/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
            </div> 
        
            <br>

            <form method="post" action="register.php"> 

                <?php include('errors.php'); ?> 
                <div class="input-group"> 
                    <label>Name<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label>
                    <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"> 
                </div> 

                <div class="input-group">
                    <label>Username<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label>
                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"> 
                </div> 

                <div class="input-group">
                    <label>Email<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>"> 
                </div> 	

                <div class="input-group"> 
                    <label>Contact<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label>
                    <input type="text" name="contact" placeholder="Contact" value="<?php echo $contact; ?>"> 
                </div> 

                <div class="input-group"> 
                    <label>Password<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label> 
                    <input type="password"  id="myInput" placeholder="********" name="password_1"> 
                </div> 
                <div class="w3-container">
                    <input type="checkbox" onclick="myFunction()"> <b>Show Password </b>
                </div>

                <div class="input-group"> 
                    <label>Confirm Password<i class="fa fa-asterisk" style="font-size:15px; color:red"></i></label>
                    <input type="password" id="myInput2" placeholder="********" name="password_2"> 
                </div> 

                <div class="w3-container">
                    <input type="checkbox" onclick="myFunction2()"> <b>Show Password </b>
                </div>

                <div class="input-group"> 
                    <button type="submit" class="btn" name="reg_user"> Register </button> 
                </div> 
            </form> 
        </div>
    
    <br>
    
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script>
function myFunction2() {
  var x = document.getElementById("myInput2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    
</body> 
</html> 
