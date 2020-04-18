<?php

require_once '../conn.php' ;

$filename = '../Export/backup.sql';
$handle = fopen($filename,"r+");
$contents = fread($handle,filesize($filename));
$sql = explode(';',$contents);
foreach($sql as $query){
  $result = mysqli_query($conn,$query);
  if($result){
      echo '<tr><td><br></td></tr>';
      echo '<tr><td>'.$query.' <b>SUCCESS</b></td></tr>';
      echo '<tr><td><br></td></tr>';
  }
}
fclose($handle);

date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y/m/d");
$time = date("h:i:s");

$deletePrevious = mysqli_query($conn, "DELETE FROM tbllastknownrestore");
$storeDateTime = mysqli_query($conn, "INSERT INTO tbllastknownrestore (date, time) VALUES ('$date', '$time')");

echo "<script> alert('Data Succesfully Imported');
        window.location.href = 'index.php';
        </script>"; 

?>