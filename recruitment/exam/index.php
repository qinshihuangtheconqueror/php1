<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
 <center>

  <div class="container2">
   <img src="banner.png" alt="Job" width="100%" style="max-width:1200px" >
	<h1>Login</h1>
   
    <hr>
<?php if(@$_REQUEST['Err']) { echo "<p style='color:red;font-weight:bold;'> ".$_REQUEST['Err']." </p>"; ?>  <?php }?>
   <form action="validate.php" method="post"> 
	<input type="text" placeholder="Email" name="candidate_email" value=""><br>
    
    <input type="password" placeholder="Exam Code" name="password" value="">
   
    <div class="clearfix">
      <button type="submit" class="signupbtn">Log In</button>
    </div>
	</form>
  </div>

	</center>
</body>
</html>
