<?php

session_start();

if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Registration</title>
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
          <a onclick="backup()" class="w3-bar-item w3-button ">
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
                <div class="w3-bar-item">REGISTRATION</div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        require_once '../conn.php';

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('m/d/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
            </div> 
            <!-- Form Container -->
            <form method="post" action="php_action/create.php" class="w3-container w3-white w3-padding-24" enctype="multipart/form-data">      
                <!-- First Row -->
                <div class="w3-row">
                    <!-- First Table -->
                    <div class="w3-half w3-container">
                        <table class="w3-table-all w3-small">
                        <tr>
                            <td> Profile Picture </td>
                            <td> : </td>
                            <td> <input type="file" id="profilePic" name="profilePic" accept="image/*"> </td>
                        </tr>
                        <tr>
                            <td> Name <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="text" id="name" name="name" required> </td>
                        </tr>
                        <tr>
                            <td> Malaysian identity card (MyKad)  <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="text" id="ic" name="ic" required> </td>
                        </tr>
                        <tr>
                            <td> Email <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="email" id="email" name="email" required> </td>
                        </tr>
                        <tr>
                            <td> Date of Birth <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="date" id="dob" name="dob" required> </td>
                        </tr>
                        <tr>
                            <td> Joined Since <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="date" id="joinedSince" name="joinedSince" required> </td>
                        </tr>
                        <tr>
                            <td> Marital Status <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> 
                                <select class="w3-select" id="maritalStatus" name="maritalStatus" required>
                                    <option value="Single">
                                        Single
                                    </option>
                                    <option value="Engaged">
                                        Engaged
                                    </option>
                                    <option value="Married">
                                        Married
                                    </option>
                                    <option value="Divorced">
                                        Divorced
                                    </option>
                                    <option value="Widowed">
                                        Widowed
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Facebook ID </td>
                            <td> : </td>
                            <td> <input class="w3-input" type="url" id="fbLink" name="fbLink"> </td>
                        </tr>
                        <tr>
                            <td> Status VISA <i class="fa fa-asterisk" style="color:red"></i> </td>
                            <td> : </td>
                            <td> 
                                <select class="w3-select" id="statusVISA" name="statusVISA" required>
                                    <option value="Valid">
                                        Valid
                                    </option>
                                    <option value="Invalid">
                                        Invalid
                                    </option>
                                    <option value="Australia Citizen">
                                        Australia Citizen
                                    </option>
                                    <option value="Permanent Resident">
                                        Permanent Resident
                                    </option>
                                </select>
                            </td>
                        </tr>

                        </table>
                    </div>
                    <!-- First Table -->

                    <!-- Second Table -->
                    <div class="w3-half w3-container">
                        <table class="w3-table-all w3-small">
                            <tr>
                                <td> Registration Number </td>
                                <td> : </td>
                                <td> 
                                    <input class="w3-input" type="text" id="regNum" name="regNum" value="<?php $date = date ('Ym') ; echo $date; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td> Status Involvement </td>
                                <td> : </td>
                                <td>
                                    <input class="w3-radio" type="radio" id="statusInvolvement" name="statusInvolvement" value="Active" checked> 
                                    <label> Active </label>

                                    <br>

                                    <input class="w3-radio" type="radio" id="statusInvolvement "name="statusInvolvement" value="Non-Active"> 
                                    <label> Non-Active </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="w3-center"> Contact Address </td>
                            </tr>
                            <tr>
                                <td colspan="2"> 1. Homeland </td>
                                <td> 2. Current <i class="fa fa-asterisk" style="color:red"></i> </td>
                            </tr>
                            <tr>
                                <td colspan="2"> 
                                    <input class="w3-input" type="text" id="homelandAdd" name="homelandAdd" placeholder="Address 1">
                                </td>
                                <td> 
                                    <input class="w3-input" type="text" id="currentAdd" name="currentAdd" placeholder="Address 2" required>   
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="w3-input" type="text" id="homelandPostcode" name="homelandPostcode" placeholder="Postal code 1">
                                </td>
                                <td>
                                    <input class="w3-input" type="text" id="currentPostcode" name="currentPostcode" placeholder="Postal code 2" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="w3-input" type="text" id="homelandCity" name="homelandCity" placeholder="City 1">
                                </td>
                                <td>
                                    <input class="w3-input" type="text" id="currentCity" name="currentCity" placeholder="City 2" required>
                                </td>                
                            </tr>
                            <tr>
                                <td colspan="3" class="w3-center"> Contact Phone Number </td>
                            </tr>
                            <tr>
                                <td colspan="2">1. Hand Phone <i class="fa fa-asterisk" style="color:red"></i> </td>
                                <td>2. Emergency Phone </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="w3-input" type="tel" id="phoneNum" name="phoneNumber" placeholder="60-XXXXXXXXX" required>
                                </td>
                                <td>
                                    <input class="w3-input" type="tel" id="emergencyNumber" name="emergencyNumber" placeholder="60-XXXXXXXXX">
                                </td>                
                            </tr>
                        </table>
                    </div>
                    <!-- Second Table -->
                </div>
                <!-- First Row -->

                <!-- Second Row -->
                <div class="w3-row w3-margin w3-card">
                    <div class="w3-card-4">
                        <header class="w3-container w3-teal">
                          <h3> Note </h3>
                        </header>

                        <br>

                        <div class="w3-container w3-center">
                          <textarea id="note" name="note" rows="10" cols="100"> </textarea>
                        </div>

                        <br>

                        <footer class="w3-container w3-teal">
                            <p> &nbsp;</p>
                        </footer>
                    </div>
                </div>
                <!-- Second Row -->

                <div class="w3-row w3-padding-24 w3-margin w3-center">
                    <button type="reset" class="w3-button w3-red"> RESET </button>

                    <button type="submit" class="w3-button w3-black"> SUBMIT </button>
                </div>

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

