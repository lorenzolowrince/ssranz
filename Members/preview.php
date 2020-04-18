<?php 
 
require_once '../conn.php';
 
if($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM tblregister WHERE id = {$id}";
    $result = $conn->query($sql);
 
    $data = $result->fetch_assoc();
 
    $conn->close();
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/tableMember.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Preview</title>
    </head>
    <body>
        
        <!-- Header -->
            <div class="w3-bar w3-teal">
                <div class="w3-bar-item"> PREVIEW </div>
                <div class="w3-bar-item w3-right"> 
                        <?php 

                        date_default_timezone_set("Asia/Kuala_Lumpur");
                        echo date('d/m/Y');
                        echo ', ';
                        echo date('h:iA');
                        ?>
                </div>
            </div>   
        <!-- Header -->
        
        <!-- Form Container -->
        <form method="post" action="php_action/archive.php" class="w3-container w3-padding-24" enctype="multipart/form-data">   

            <div class="w3-container">
                <table class="w3-table-all">
                    <tr>
                        <td colspan="6" class="w3-center"> 
                            <input type="hidden" id="profilePic" name="profilePic">
                            <img src="php_action/profilePic/<?php echo $data['profilePic'] ?>" alt="profilePic" width="15%">
                        </td>
                    </tr>
                    <tr>
                        <td> Name </td>
                        <td> : </td>
                        <td>
                            <input type="hidden" id="name" name="name">
                            <?php echo $data['name'] ?>
                        </td>                             
                        <td> Registration Number </td>
                        <td> : </td>
                        <td>
                            <input type="hidden" name="regNum" id="regNum" />
                            <?php echo $data['regNum'] ?>
                        </td>                        
                    </tr>                    
                    <tr>
                        <td> Malaysian identity card (MyKad) </td>
                        <td> : </td>
                        <td>
                            <input type="hidden" id="ic" name="ic"> 
                            <?php echo $data['ic'] ?>
                        </td>                             
                        <td> Status Involvement </td>
                        <td> : </td>
                        <td>
                            <input type="hidden" name="statusInvolvement" id="statusInvolvement" />
                            <?php echo $data['statusInvolvement'] ?>
                        </td>                        
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="email" name="email"> 
                            <?php echo $data['email'] ?>
                        </td>
                        <td colspan="3" class="w3-center"> Contact Address </td>
                    </tr>
                    <tr>
                        <td> Date of Birth (Y/m/d) </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="dob" name="dob">
                            <?php echo $data['dob'] ?>
                        </td>
                        <td colspan="2"> 1. Homeland </td>
                        <td> 2. Current </td>
                    </tr>
                    <tr>
                        <td> Joined Since (Y/m/d) </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="joinedSince" name="joinedSince"> 
                            <?php echo $data['joinedSince'] ?>
                        </td>
                        <td colspan="2"> 
                            <input type="hidden" id="homelandAdd" name="homelandAdd">
                            <?php echo $data['homelandAdd'] ?>
                        </td>
                        <td> 
                            <input type="hidden" id="currentAdd" name="currentAdd">   
                            <?php echo $data['currentAdd'] ?>  
                        
                        </td>
                    </tr>
                    <tr>
                        <td> Marital Status </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="maritalStatus" name="maritalStatus">
                            <?php echo $data['maritalStatus'] ?>
                        </td>
                        <td colspan="2">
                            <input type="hidden" id="homelandPostcode" name="homelandPostcode">
                            <?php echo $data['homelandPostcode'] ?>
                        </td>
                        <td>
                            <input type="hidden" id="currentPostcode" name="currentPostcode">
                            <?php echo $data['currentPostcode'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Facebook ID </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="fbLink" name="fbLink"> 
                            <?php echo $data['fbLink'] ?>
                        </td>
                        <td colspan="2">
                            <input type="hidden" id="homelandCity" name="homelandCity">
                            <?php echo $data['homelandCity'] ?>
                        </td>
                        <td>
                            <input type="hidden" id="currentCity" name="currentCity" >
                            <?php echo $data['currentCity'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td> Status VISA </td>
                        <td> : </td>
                        <td> 
                            <input type="hidden" id="statusVISA" name="statusVISA">   
                            <?php echo $data['statusVISA'] ?>
                        </td>
                        <td rowspan="4" colspan="3"> </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="w3-center"> Contact Phone Number </td>
                    </tr>
                    <tr>
                        <td colspan="2">1. Hand Phone </td>
                        <td>2. Emergency Phone </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" id="phoneNumber" name="phoneNumber">
                            <?php echo $data['phoneNumber'] ?>
                        </td>
                        <td>
                            <input type="hidden" id="emergencyNumber" name="emergencyNumber">
                            <?php echo $data['emergencyNumber'] ?>
                        </td>  
                    </tr>
                    <tr>
                        <td colspan="6"><h2> Note </h2></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br>
                            <div class="w3-container w3-center">
                                <textarea id="note" name="note" rows="10" cols="100" readonly><?php echo htmlspecialchars($data['note']);?></textarea>
                            </div>
                            <br>
                        </td>       
                    
                    </tr>
                </table>
            </div>
            
            <br>
            
            <div class="w3-row">
                <div class="w3-container w3-center w3-margin w3-padding-24"> 
                    
                    <input type="hidden" name="id" id="id" value="<?php echo $data['id']?>" />
                    
                    <a href="index.php" id="printPageButton" type="button" class="w3-button w3-black">BACK</a>
                    
                    <button  id="printPageButton" type="submit" class="w3-button w3-black"> ARCHIVE </button>    
                    
                    <a href="#print" id="printPageButton" onClick="document.title = '<?php echo $data['name']?>'; window.print();" type="button" class="w3-button w3-black"> PRINT </a>
                        
                    <br>
                        
                    <div class="example-print">This is a confidential information.</div>
                </div>
            </div>

        </form>
    </body>
</html>


 
<?php
}
?>