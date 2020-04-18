<?php 

error_reporting(E_NOTICE);
 
require_once '../../conn.php';

if($_POST) {
    
    $regDate = date("d/m/Y"); //CAN
    $name = $_POST['name']; //CAN
    $ic = $_POST['ic']; //CAN
    $email = $_POST['email']; //CAN
    $dob = $_POST['dob']; //CAN
    $joinedSince = $_POST['joinedSince']; //CAN
    $maritalStatus = $_POST['maritalStatus']; //CAN
    $fbLink = $_POST['fbLink']; //CAN
    $statusVISA = $_POST['statusVISA']; //CAN
    $regNum = $_POST['regNum']; //CAN
    $statusInvolvement = $_POST['statusInvolvement']; //CAN
    $homelandAdd = $_POST['homelandAdd']; //CAN
    $currentAdd = $_POST['currentAdd']; //CAN
    $homelandPostcode = $_POST['homelandPostcode']; //CAN
    $currentPostcode = $_POST['currentPostcode']; //CAN
    $homelandCity = $_POST['homelandCity']; //CAN
    $currentCity = $_POST['currentCity']; //CAN
    $phoneNumber = $_POST['phoneNumber']; //CAN
    $emergencyNumber = $_POST['emergencyNumber']; //CAN
    $note = $_POST['note']; //CAN
 
    $id = $_POST['id'];
      
    //EDIT PROFILE PIC
    $imgFile = $_FILES['profilePic']['name'];
    $tmp_dir = $_FILES['profilePic']['tmp_name'];
    $imgSize = $_FILES['profilePic']['size'];

    if($imgFile)
    {   
        $upload_dir = 'profilePic/'; // upload directory 
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $profilePic = rand(1000,1000000).".".$imgExt;
        
        if(in_array($imgExt, $valid_extensions))
        {   
            if($imgSize < 5000000)
            {   
                move_uploaded_file($tmp_dir,$upload_dir.$profilePic);
            }
            else
            {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
            }
       }
       else
       {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
       } 
    }
    else
    {
        // if no image selected the old image remain as it is.
        $query = mysqli_query($conn, "SELECT * FROM tblregister");
        $image = mysqli_fetch_array($query);
        
        $profilePic = $image['profilePic']; // old image from database
    } 
    //EDIT PROFILE PIC
    
    
    $sql = "UPDATE tblregister SET profilePic = '$profilePic', statusInvolvement = '$statusInvolvement', name = '$name', ic = '$ic', email = '$email', dob = '$dob', joinedSince = '$joinedSince', maritalStatus = '$maritalStatus', fbLink = '$fbLink', statusVISA = ' $statusVISA', homelandAdd = '$homelandAdd ', currentAdd = '$currentAdd', homelandPostcode = '$homelandPostcode', currentPostcode = '$currentPostcode', homelandCity = '$homelandCity', currentCity = '$currentCity', phoneNumber = '$phoneNumber', emergencyNumber = '$emergencyNumber', note = '$note' WHERE id = {$id} ";
    
?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Update</title>
    </head>
    <body>
        
        <div class="w3-bar w3-teal">
            <div class="w3-bar-item">UPDATE</div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('d/m/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
        </div>    

        
        <div class="w3-row">
            <div class="w3-container w3-center">
            <?php

                if($conn->query($sql) === TRUE) {
                    echo "<h2>Record Successfully Updated</h2>";
                    
                    echo "<a href='../index.php'><button class='w3-button w3-black w3-margin' type='button'>HOME</button></a>";
                } else {
                        echo "Error " . $sql . ' ' . $conn->connect_error;
                }

            ?>
            </div>
        </div>
        
        <?php
    
            $conn->close();
        }   
        ?>
    </body>
</html>
