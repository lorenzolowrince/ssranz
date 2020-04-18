<?php 

error_reporting(E_NOTICE);

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

 
if($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM tbldiary WHERE id = {$id}";
    $result = $conn->query($sql);
 
    $data = $result->fetch_assoc();
 
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/tableDiary.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - View Diary</title>
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
                <div class="w3-bar-item">VIEW DIARY</div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('d/m/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>

            </div> 


            <!-- Form Container -->
            <form method="post" action="php_action/update.php" class="w3-container w3-padding-24" enctype="multipart/form-data">      



                <div class="w3-row w3-container w3-margin w3-padding-small">

                    <div class="w3-third">
                        &nbsp;
                    </div>
                    <!-- Create Diary -->
                    <table class="w3-third table w3-large">
                        <tr>
                            <td class="w3-center"> Title </td>
                            <td>
                                <input class="w3-input" type="text" id="title" name="title" value="<?php echo $data['title']  ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="w3-center"> Label </td>
                            <td>
                                <input class="w3-input" type="text" id="label" name="label" value="<?php echo $data['label']  ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="w3-center"> Attached Doc. </td>
                            <td class="w3-center"> 
                                <a href="php_action/tempFile/<?php echo $data['document'] ?>" target="_blank"> View File</a>
                            </td>
                        </tr>
                    </table>
                    <!-- Create Diary -->
                    <div class="w3-third">
                        &nbsp;
                    </div>

                </div>

                <br>

                <div class="w3-row w3-container">
                    <div class="w3-card-4">

                    <header class="w3-container w3-teal">
                      <h2> Note</h2>
                    </header>

                    <div class="w3-container w3-center">
                      <p><textarea readonly name="note" id="note" cols="100" rows="25"><?php echo htmlspecialchars($data['note']);?> </textarea></p>
                    </div>

                    <footer class="w3-container w3-teal">
                      <p> &nbsp; </p>
                    </footer>

                    </div>
                </div>

                <br>

                <div class="w3-row w3-padding-24 w3-margin w3-center">
                    <input type="hidden" name="id" id="id" value="<?php echo $data['id']?>" />
                </div>

                <br>

            </form>
            <!-- Form Container -->
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

<?php
}
?>