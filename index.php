<?php include('server.php') ?> 
<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<title> 
		SSRANZ - Login
	</title> 
	
	<link rel="stylesheet" type="text/css" href="style.css"> 
</head> 
<body class="w3-gray"> 
	<div class="header"> 
	<p style="font-size:15px">SABAH SARAWAK RIGHTS - AUSTRALIA NEW ZEALAND INCORPORATED</p>
	<p style="font-size:15px">(SSRANZ)</p>
	</div> 
	
	<form method="post" action="index.php"> 

		<?php include('errors.php'); ?> 

		<div class="input-group"> 
			<label><i class="fa fa-user" aria-hidden="true"></i> Username</label> 
			<input type="text" name="username" > 
		</div> 
		<div class="input-group"> 
			<label><i class="fa fa-key" aria-hidden="true"></i> Password</label> 
			<input class="w3-input" id="myInput" type="password" name="password">
		</div> 
        
        <div class="w3-container">
            <input type="checkbox" onclick="myFunction()"> <b>Show Password </b>
        </div>
        
		<div class="input-group"> 
			<button type="submit" class="btn" name="login_user"> 
				Login 
			</button> 			
		</div>
	</form> 
    
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body> 

</html> 
