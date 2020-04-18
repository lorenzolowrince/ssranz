<?php 

error_reporting(E_NOTICE);

require_once '../../conn.php';
 
if($_POST) {
    $id = $_POST['id'];
    
    $query = mysqli_query($conn, "SELECT * FROM tblregister");    
    
    while($fetch = mysqli_fetch_array($query)){
        if($fetch['id'] ===  $id){ 
            
            mysqli_query($conn, "UPDATE tblregister SET statusInvolvement='Non-Active' WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            mysqli_query($conn, "INSERT INTO tblarchived SELECT * FROM tblregister WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM tblregister WHERE id ='$fetch[id]'") or die(mysqli_error($conn));
            
            
            echo "<script>
            alert('Data Has Been Archived');
            window.location.href = '../index.php';
            </script>";
            exit;
		}
    }

    $conn->close();
}
 
?>