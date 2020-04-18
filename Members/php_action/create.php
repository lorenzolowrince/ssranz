<?php 

error_reporting(E_NOTICE);
 
require_once '../../conn.php';
 
if($_POST) {
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
    $homelandAdd= $_POST['homelandAdd']; //CAN
    $currentAdd = $_POST['currentAdd']; //CAN
    $homelandPostcode = $_POST['homelandPostcode']; //CAN
    $currentPostcode = $_POST['currentPostcode']; //CAN
    $homelandCity = $_POST['homelandCity']; //CAN
    $currentCity = $_POST['currentCity']; //CAN
    $phoneNumber = $_POST['phoneNumber']; //CAN
    $emergencyNumber = $_POST['emergencyNumber']; //CAN
    $note = $_POST['note']; //CAN   

    //PROFILE PICTURE FUCTION
    $imgFile = $_FILES['profilePic']['name'];
    $tmp_dir = $_FILES['profilePic']['tmp_name'];
    $imgSize = $_FILES['profilePic']['size'];
    
    $upload_dir = 'profilePic/' ;
    
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

    // rename uploading image
    $profilePic = rand(1000,1000000).".".$imgExt;

    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){   
        // Check file size '5MB'
        if($imgSize < 5000000) {
            move_uploaded_file($tmp_dir,$upload_dir.$profilePic);
            }
            else
            {   
                $errMSG = "Sorry, your file is too large.";
                }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
            }
    //PROFILE PICTURE FUCTION
    
    $sql = "INSERT INTO tblregister (id, profilePic, note, emergencyNumber, phoneNumber, currentCity, currentPostcode, currentAdd, homelandCity, homelandPostcode, homelandAdd, statusInvolvement, statusVISA, maritalStatus, fbLink, ic, dob, joinedSince, name, email) VALUES (NULL, '$profilePic', '$note', '$emergencyNumber', '$phoneNumber', '$currentCity', '$currentPostcode', '$currentAdd', '$homelandCity','$homelandPostcode', '$homelandAdd', '$statusInvolvement', '$statusVISA', '$maritalStatus', '$fbLink', '$ic', '$dob', '$joinedSince', '$name', '$email')";
    
    // AUTO REG NUM
    if(mysqli_query($conn, $sql)){
    // Obtain last inserted id
    $last_id = mysqli_insert_id($conn);}
    

    $id = strtotime($joinedSince);
    $date = date('Ym', $id);
    
    $query = "SELECT * FROM tblregister" ;
    $result = mysqli_query($conn, $query) ;
    
    if ($result) 
    { 
        $row = mysqli_num_rows($result); 

        // close the result. 
        mysqli_free_result($result); 
    } 
    
    for($i = 0 ; $i <= $row ; $i++){
        
        $num = str_pad($last_id, 4, '0', STR_PAD_LEFT) ;
        $newNum = $num;
    
    }
    $newRegNum = $date . $newNum ;

    
    $sql = "UPDATE tblregister SET regNum = '$newRegNum' WHERE id = '$last_id'";
    // AUTO REG NUM
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Create</title>
    </head>
    <body>
        
        <div class="w3-bar w3-teal">
            <div class="w3-bar-item">CREATE</div>
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
                    echo "<h2>New Record Successfully Created</h2>";

                    echo "<a href='../Register.php'><button class='w3-button w3-black w3-margin' type='button'>BACK</button></a>";
                    
                    
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





