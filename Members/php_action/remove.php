<?php 

error_reporting(E_NOTICE);
 
require_once '../../conn.php';
 
if($_POST) {
    $id = $_POST['id'];
 
    $sql = "DELETE FROM tblregister WHERE id = {$id}";
    if($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Member Data Has Been Deleted');
        window.location.href = '../index.php';
        </script>";
        exit;
    } else {
        echo "Error updating record : " . $conn->error;
    }
 
    $conn->close();
}
 
?>