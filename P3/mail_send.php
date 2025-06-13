<?php
// require_once('include/config.php');
// $Admins = new admins;
// print_r($_POST);exit; 
// $host = 'localhost';
// $user = 'artefact_user';
// $pass = 'NyDv=lEo80;s';
// $database = 'artefact';
// mysql_connect($this->host, $this->user, $this->pass) or die ('could not connect to the database');
// mysql_select_db($this->database) or die ('could not connect to the database'.$this->database);
//echo "hello";
ob_start();
$con = mysql_connect('localhost','artefact_user','$Pass123') OR die('could not connect to the localhost');
mysql_select_db('artefact') or die ('could not connect to the database');
session_name('Auth');
session_start();
// print_r($_POST);exit;
// print_r($_FILES);exit;

if(!empty($_POST))
{
if($_FILES['resume']['error'] == '0')
	{
		$src = $_FILES['resume']['tmp_name'];
		$imgname = time()."_".$_FILES['resume']['name'];
		$desc = "resume/".$imgname;
		if(move_uploaded_file($src, $desc))
		{
			$_POST['resume'] = $imgname;
		}
	}  

$sql = mysql_query("INSERT INTO careers SET name='".$_POST['name']."', email='".$_POST['email']."', contact = '".$_POST['contact']."', position = '".$_POST['position']."', preffered_location = '".$_POST['preffered_location']."', interview_location = '".$_POST['interview_location']."', resume='".$_POST['resume']."', created='".date('Y-m-d H:i:s')."', modified='".date('Y-m-d H:i:s')."' ");
if(!empty($sql)){
	// echo "Successfully save data";
	$GetData = mysql_query("select * from careers ORDER BY id DESC LIMIT 1");
	//print_r(mysql_fetch_array($GetData));exit;
	// $getdata = mysql_fetch_array($GetData);
	// print_r($getdata);exit;
	// echo "Name : ".$getdata[0]['name'];
					$portal_name    = 'Artefact Projects';			
					$to      		= 'artefactnagpur@gmail.com, priya@artefactprojects.com';
					
					$subject 		= 'Application for the post of '. $_POST['position']. ' - web inquiry';
					$body 		= 	"<html><body> 
									<div>Dear Admin,</div>
									<div> <h3>New career Registration in artefactprojects</h3></div>
									<div> <span>Name: </span>". $_POST['name']."</span></div>
									<div> <span>Email: </span>". $_POST['email']."</span></div>
									<div> <span>Contact: </span>". $_POST['contact']."</span></div>
									<div> <span>Preffered Position: </span>". $_POST['position']."</span></div>
									<div> <span>Preffered Location: </span>". $_POST['preffered_location']."</span></div>
									<div> <span>Interview Location: </span>". $_POST['interview_location']."</span></div>
									<div> <span>Resume: </span> <a href='http://www.artefactprojects.com/".$desc."' download>Download Attached File</a></span></div>
									</body> </html>";
					$from 		 = 	"info@artefactprojects.com";
					$headers 	 = 	"MIME-Version: 1.0\r\n";
					$headers 	.= 	"Content-type:text/html; charset=iso-8859-1\r\n";		
					$headers 	.= 	"From: ".ucwords($portal_name)." <".$from.">\r\n";
	               @mail($to, $subject, $body, $headers); 
					//print_r($body);
	                echo "<script type='text/javascript'>alert('Thank you for Application');</script>";
					echo '<script type="text/javascript">
					window.location="career.html";
					</script>';exit;
	               // echo "Success";
}
else{
	echo "Data not save";
}
}
//header("Location:career.html");
?>