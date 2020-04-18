<?php 

error_reporting(E_NOTICE);
 
require_once '../../conn.php';

if($_POST) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
 
    $id = $_POST['id'];
     
    $sql = "UPDATE tbladmin SET name = '$name', email = '$email', username = '$username', contact = '$contact' WHERE id = {$id} ";
    
?>  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Admin Update</title>
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
                    echo "<h2>Admin Successfully Updated</h2>";
                    
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
