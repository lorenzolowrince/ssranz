<?php 

error_reporting(E_NOTICE);

require_once '../../conn.php';
 
if($_POST) {
    $id = $_POST['id'];
    
    $query = mysqli_query($conn, "SELECT * FROM tblarchived");    
    
    while($fetch = mysqli_fetch_array($query)){
        if($fetch['id'] ===  $id){ 
            
            mysqli_query($conn, "UPDATE tblarchived SET statusInvolvement='Active' WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            mysqli_query($conn, "INSERT INTO tblregister SELECT * FROM tblarchived WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM tblarchived WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            
            
            echo "<script>
            alert('Data Has Been Active');
            window.location.href = '../index.php';
            </script>";
            exit;
		}
    }

    $conn->close();
}
 
?>