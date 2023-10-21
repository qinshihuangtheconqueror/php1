<?php
include 'phphr_api.php';


?>
<?php
if ($_SERVER["REQUEST_METHOD"]== "POST") 
{ 

    $candidate_email = $_POST["candidate_email"];
    $password = $_POST["password"];
$PHPHR = curl_init();
curl_setopt_array($PHPHR, array(
  CURLOPT_URL=>$WebURL.'/index.php/api/exam_code/exam/'.$password,
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
//print_r($data); exit;	
	
    $examdate = time();
    $check_credential=0;
	$check_date=0;
	$check_exam_given=0;
    foreach($data['data']['assessments'] as $user) 
	{   
    if(($user['candidate_email'] == $candidate_email) && ($user['exam_code'] == $password))
			{
				$date = DateTime::createFromFormat('d/m/Y', $user['end_date']);
				$end_date = $date->format('U');
				
				
				if($end_date>=$examdate){$check_date=1;}
				if($user['ended']==0){$check_exam_given=1;}
					$check_credential=1;
					$candidate_id=$user['candidate_id'];
					$category_id=$user['category_id'];
					$assessment_id=$user['id'];
						
					
				}		
       
    }
	if($check_credential==1 && $check_date==1 && $check_exam_given==1)
	{	session_start();
		$_SESSION["auth"] = "1";
		$_SESSION["candidate_id"]=$candidate_id;
		$_SESSION["assessment_id"]=$assessment_id;
		header("Location: instruction.php?ID=$category_id");
		exit;
		
	}
	else if($check_date==0 && $check_credential==1)
	{
		header("Location: index.php?Err=Link Expired.");
		exit;
	}else if($check_exam_given==0 && $check_credential==1)
	{
		header("Location: index.php?Err=Exam Already Given.");
		exit;
	}
	else
	{
		header("Location: index.php?Err=Username and Passord are incorrect.");
		exit;
    }    
}
else
{
		header("Location: index.php");	exit;	
}	
  
?>