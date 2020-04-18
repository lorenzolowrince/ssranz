<?php
	
    require_once '../../conn.php' ;
 
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
 
	//set timezone
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$year = date('Y');
	$total = array();
	for ($month = 1; $month <= 12; $month++){
        
        //NEED TO DO THIS
        
        $sql="
        SELECT *, COUNT(id) AS total
        FROM tblregister
        WHERE MONTH(joinedSince) = '$month'
        AND YEAR(joinedSince) = '$year'
        ";
        
		$query = $conn->query($sql) or die("Last error: {$conn->error}\n");
        
		$row = $query->fetch_array();
 
		$totalReg = $row['total'];        
        
        $sql="
        SELECT *, COUNT(id) AS total
        FROM tblarchived
        WHERE MONTH(joinedSince) = '$month'
        AND YEAR(joinedSince) = '$year'
        ";
        
		$query = $conn->query($sql) or die("Last error: {$conn->error}\n");
        
		$row = $query->fetch_array();
 
		$totalArc = $row['total'];
        
        $total[] = $totalReg + $totalArc;
	}
 
	$tjan = $total[0];
	$tfeb = $total[1];
	$tmar = $total[2];
	$tapr = $total[3];
	$tmay = $total[4];
	$tjun = $total[5];
	$tjul = $total[6];
	$taug = $total[7];
	$tsep = $total[8];
	$toct = $total[9];
	$tnov = $total[10];
	$tdec = $total[11];
?>