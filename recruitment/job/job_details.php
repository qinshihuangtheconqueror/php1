<?php
$JobID=$_REQUEST['JobID'];
if(!$JobID) { header("Location:index.php"); exit();  }
include 'phphr_api.php';
$PHPHR = curl_init();
curl_setopt_array($PHPHR, array(
  CURLOPT_URL=>$WebURL.'/index.php/api/job/job/'.$Token_Key,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($PHPHR);
$data = json_decode($response,true);

?>
<!DOCTYPE html>
<html>
<head>
<title>Apply For Job</title>
</head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<img src="banner.png" alt="Job" width="100%" height="350"/>
<center>
<table class="styled-table">

        <tbody>
            <?php
                foreach($data['data']['job'] as $row){ if($row['id']==$JobID) {
					
					if($row['job_status']!=='Open') { header("Location:index.php"); exit();  }
					
					?>
                <h1><?php echo $row['title']; ?></h1>
				<tr>
					<td colspan="2"><?php echo htmlspecialchars_decode($row['description']); ?></td>
				</tr>
				<tr>
					<td><b>Required Skills: </b><?php echo $row['req_skill']; ?></td>
				</tr>
				<tr>
					<td><b>Experiance Required: </b><?php echo $row['experiance']; ?></td>
				</tr>
				<tr>
					<td><b>Location: </b><?php echo $row['location']; ?></td>
				</tr>
				<tr>
					<td><b>Apply Before: </b><?php echo $row['expire_date']; ?></td>
				</tr>
				<?php }} ?>
        </tbody>

    </table>
	<hr>
<h3>Job Application Form </h3>
</center>
  <form action="submit_application.php" method="post" enctype='multipart/form-data'>
     <input type="hidden" id="job_title" name="job_title" value="<?php echo $JobID;?>">
	 <input type="text" id="name" name="name" placeholder="Enter Full Name." required>
    <input type="text" id="email" name="email" placeholder="Enter Email Address." required>
    <input type="text" id="contact" name="contact" placeholder="Enter Phone Number." >
	  <label for="resume">Upload Resume*  </label>&nbsp&nbsp
	<input type="file" id="resume" name="resume"  required="true" accept="image/png, image/jpeg, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />(Only .pdf,.doc, .docx, .png, .jpeg Allowed) <br><br>
	<input type="hidden" id="refer" name="refer" value="<?php echo $_REQUEST['refer']; ?>" />
	<input type="hidden" id="d" name="d" value="<?php echo $_REQUEST['d']; ?>" />
    <center><input type="submit" value="Apply For Job"></center>
  </form>
</div>
</body>
</html>

