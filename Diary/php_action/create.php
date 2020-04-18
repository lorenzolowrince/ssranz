<?php 

error_reporting(E_NOTICE);
 
require_once '../../conn.php';
 
if($_POST) {
    $title = $_POST['title'];
    $label = $_POST['label'];
    $submitDate = date("d/m/Y");
    $note = $_POST['note'];
    
    
    //UPLOAD DOCUMENT
    $fileTmpPath = $_FILES['document']['tmp_name'];
    $fileName = $_FILES['document']['name'];
    $fileSize = $_FILES['document']['size'];
    $fileType = $_FILES['document']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    $document = md5(time() . $fileName) . '.' . $fileExtension;
    
    $allowedfileExtensions = array('txt', 'xls', 'doc', 'pdf');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // directory in which the uploaded file will be moved
        $uploadFileDir = 'tempFile/';
        $dest_path = $uploadFileDir . $document;

        if(move_uploaded_file($fileTmpPath, $dest_path))
        {
          $message ='File is successfully uploaded.';
        }
        else
        {
          $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
    }
    //UPLOAD DOCUMENT
    
    $sql = "INSERT INTO tbldiary (title, label, submitDate, note, document) VALUES ('$title', '$label', now(), '$note', '$document')";
    
    if($conn->query($sql) === TRUE) {
        echo "<script>
        alert('$message');
        window.location.href = '../index.php';
        </script>";
        exit;
    } else {
        echo "Error updating record : " . $conn->error;
    }
 
    $conn->close();
}
?>





