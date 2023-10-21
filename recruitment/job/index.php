<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs</title>
</head>
<body>
<div class="container">    

	<center>
	<img src="banner.png" alt="Job" width="100%" height="350"/>
	
    <table class="styled-table">
    <thead>
        <tr>
				<th>Date</th>
				 <th style="width:60%">Title</th>
				<th></th>
        </tr>
    </thead>
    <tbody>
         <?php
 				foreach($data['data']['job'] as $row){?>
                <tr>
                    <td><?php $date = $row['created_on'];
						$year = date('F j,Y', strtotime($date));
						echo $year;?></td>
                    <td><?php echo $row['title']; ?></td>
					<td>
					<?php if($row['job_status']=="Open") {?>
					<a href="job_details.php?JobID=<?php echo $row['id']; ?>&refer=<?php echo @$_REQUEST['refer']; ?>&d=<?php echo @$_REQUEST['d']; ?>" >Apply For This Job!</a><?php } else { echo "Closed"; }?>
					
					</td>
                </tr>
				
            <?php }?>
    </tbody>
</table>

	</center>
	</div>
</body>
</html>

