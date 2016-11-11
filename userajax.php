<?php
//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		case 2:
			login();
		break;
		case 3:
			addPool();
		break;
		case 4:
			getPool();
		break;
		case 5:
			addNews();
		case 6:
			updatePool();
		break;
		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}
function addUser(){
    if(!isset($_REQUEST['username'])){
		echo '{"result":0,"message":"Add a username please"}';
		return;
	}
	if(!isset($_REQUEST['firstname'])){
		echo '{"result":0,"message":"Add a first name please"}';
		return;
	}
	if(!isset($_REQUEST['lastname'])){
		echo '{"result":0,"message":"add last name please"}';
		return;
	}
    if(!isset($_REQUEST['email'])){
		echo '{"result":0,"message":"add your phonenumber please"}';
		return;
	}
	
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Set a password"}';
		return;
	}

	if($_REQUEST['firstname']==""){
		echo '{"result":0,"message":"No first name given"}';
		return;
	}
	if($_REQUEST['lastname']==""){
		echo '{"result":0,"message":"No last name given"}';
		return;
	}
	if($_REQUEST['username']==""){
		echo '{"result":0,"message":"No username given"}';
		return;
	}
    if($_REQUEST['phonenumber']==""){
		echo '{"result":0,"message":"No phonenumber given"}';
		return;
	}
		if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Password not set"}';
		return;
	}
	$username=$_REQUEST['username'];
    $firstname=$_REQUEST['firstname'];
	$lastname=$_REQUEST['lastname'];
	$phonenumber=$_REQUEST['phonenumber'];
	$password=$_REQUEST['password'];
	include('users.php');
	$obj=new users();
	$row=$obj->addUser($username,$firstname, $lastname, $phonenumber, $password);

	if($row==true){
		echo '{"result":1,"message":"User added"}';
	}

	else{
		echo '{"result":0,"message":"User not added"}';
	}

}


function login(){
	
	if(!isset($_REQUEST['username'])){
		echo '{"result":0,"message":" Give usernam"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Give password"}';
		return;
	}
	if($_REQUEST['username']==""){
		echo '{"result":0,"message":"Username not given"}';
		return;
	}
	if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Password not given"}';
		return;
	}
	4USERNAME=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	include('users.php');
	$obj=new users();
	$row=$obj->login($username, $password);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"user":';
		echo json_encode($row);
		echo "}";
	}

	else{
		echo '{"result":0,"message":"Login failed"}';
	}

}
function getPool(){

	include('users.php');
	$obj=new users();
	$row=$obj->getPool();
	if($row==true){
		$row=$obj->fetch();
			echo '{"result":1,"pool":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch pools"}';
	}

}

function addPool(){
    if(!isset($_REQUEST['poolid'])){
		echo '{"result":0,"message":"give your pool a name"}';
		return;
	}
	if(!isset($_REQUEST['location'])){
		echo '{"result":0,"message":"give you location"}';
		return;
	}
	if(!isset($_REQUEST['destination'])){
		echo '{"result":0,"message":"give your destination"}';
		return;
	}
    if(!isset($_REQUEST['phonenumber'])){
		echo '{"result":0,"message":"give your phonenumber"}';
		return;
	}
	if($_REQUEST['poolid']==""){
		echo '{"result":0,"message":"your pool has no name"}';
		return;
	}
	if($_REQUEST['location']==""){
		echo '{"result":0,"message":"location not given"}';
		return;
	}
	if($_REQUEST['destination']==""){
		echo '{"result":0,"message":"Destination not given"}';
		return;
        
    }
    if($_REQUEST['phonenumber']==""){
		echo '{"result":0,"message":"Phonenumber not given"}';
		return;
	
	$poolid=$_REQUEST['poolid'];
	$location=$_REQUEST['location'];
	$destination=$_REQUEST['destination'];
	$phonenumber=$_REQUEST['phonenumber'];
	
	include('users.php');
	$obj=new users();
	$row=$obj->addPool($email,$source, $destination, $date, $starttime, $endtime,$carregistration,$cartype,$broadcast);

	if($row==true){
		echo '{"result":1,"message":"Pool added"}';
	}
	else{
		echo '{"result":0,"message":"Pool not added"}';
	}

}

function updatePool(){
	$poolid=$_REQUEST['poolid'];
	$mode=$_REQUEST['mode'];
	include('users.php');
	$obj=new users();
	$row=$obj->updatePool(1,$poolid,$mode);

	if($row==true){
		echo '{"result":1,"message":"Sucessfully joined pool"}';
	}
		
	
	else{
		echo '{"result":0,"message":"An error occured while joining pool"}';
	}
}


function addNews(){
	if(!isset($_REQUEST['location'])){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}
	if(!isset($_REQUEST['image'])){
		echo '{"result":0,"message":"Image is not given"}';
		return;
	}
	if(!isset($_REQUEST['description'])){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}
	$location=$_REQUEST['location'];
	$image=$_REQUEST['image'];
	echo $image;
	exit;
	$description=$_REQUEST['description'];

	if(getimagesize($FILES[$image]['tmp_name'])==false){
        echo("Please select an image");
      }
      else{
        $imageslash=addslashes($FILES[$image]['tmp_name']);
        $locationslash=addslashes($FILES[$image][$location]);
        $imageslash=file_get_contents($imageslash);
        $imageslash=base64_encode($imageslash);
      }
	
	
	
	include('users.php');
	$obj=new users();
	$row=$obj->addImage($location, $imageslash, $description);

	if($row==true){
		echo '{"result":1,"message":"News added"}';
	}
	else{
		echo '{"result":0,"message":"News not added"}';
	}

}

?>
