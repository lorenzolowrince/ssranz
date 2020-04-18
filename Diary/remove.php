<?php 
 
require_once '../conn.php';
 
if($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM tbldiary WHERE id = {$id}";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    
    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>SSRANZ - Remove Diary</title>
    </head>
    
    <body>
        
        <div class="w3-bar w3-teal">
            <div class="w3-bar-item">&nbsp;</div>
        </div>  
        
        <div class="w3-row">
            <div class="w3-container w3-center">
                <h3>Do you really want to remove, <?php echo $data['title'] ?> ?</h3>
                    <form action="php_action/remove.php" method="post">
                        
                        <div class="w3-row w3-padding-24 w3-margin w3-center">
                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />

                            <button class="w3-button w3-black" type="submit">DELETE</button>

                            <a href="index.php"><button class="w3-button w3-black" type="button">BACK</button></a>
                        </div>
                        
                    </form>
            </div>
        </div>

 
</body>
</html>
 
<?php
}
?>