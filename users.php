<?php
/*
*@Author Anne Gitau
*/
include_once("adb.php");
/**
*Users  class
*/
class users extends adb{
	function users(){
	}
	
	
        function login($username,$password){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="select * from user where password like '$password' and username like '$username'";
			
			return $this->query($strQuery);
		}
	function addUser($username,$firstname,$lastname,$password,$phonenumber,$status){
		$strQuery="insert into users set
						username='$username',
						firstname='$firstname',
						lastname='$lastname',
                        phonenumber=$phonenumber,
						password=MD5('$password')";
                        
                       
		return $this->query($strQuery);				
	}
    /**
	*gets user records based on the filter
	*@param string mixed condition to filter. If  false, then filter will not be applied
	*@return boolean true if successful, else false
	*/
	function getUsers($filter=false){
		$strQuery= "select * from users";
		if($filter!=false){
			$strQuery=$strQuery. " where $filter";
		}
		 $strQuery;
		return $this->query($strQuery);		
	}	
	/**
	*Searches for user by username, fristname, lastname 
	*@param string text search text
	*@return boolean true if successful, else false
	*/
	function searchUsers($text=false,$usergroup=false){
		$filter=false;
		if($text!=false && $usergroup!=false){
			$filter="(username like '%$text%' or firstname like '%$text%' or lastname like '%$text%' ) and phonenumber=$usergroup";
		}
		else if($text!=false){
				$filter="(username like '%$text%' or firstname like '%$text%' or lastname like '%$text%')";
				}
		else if($usergroup!=false){
			$filter="phonenumber=$phonenumber";
		}		
		return $this->getUsers($filter);
	}
	function editUsers($username,$firstname,$lastname,$phonenumber){
		$strQuery="update users set
						firstname='$firstname',
						lastname='$lastname',
						phonenumber='$phonenumber' where username=$username	";
						echo "User Edited";
		return $this->query($strQuery);				
	}
	
	function updateStatus($usercode,$status){
			$user=strcmp("ENABLED", $status);
			if($user==0){
				$strQuery="UPDATE users set status='DISABLED' WHERE usernmae=$username";
			}
			else{
				$strQuery="UPDATE users set status='ENABLED' WHERE username=$username";
				}
				echo "Status Updated";
		 return $this->query($strQuery);
	}
	/**
	*delete user
	*@param int usercode the user code to be deleted
	*returns true if the user is deleted, else false
	*/
	function deleteUser($usercode){
		$strQuery= "delete from users where username='$username'";
		echo "User Deleted";
		return $this->query($strQuery);
		
	}
    	function addPool($poolid,$location,$destination,$phonenumber){
		$strQuery="insert into pool set
						poolid='$poolid',
						location='$location',
						destination='$destination',
						poolstatus='$phonenmber'";
		return $this->query($strQuery);				
	}
   
	function getPool($filter=false){
		$strQuery="select * from pool";
		/*if($filter!=false){
			$strQuery=$strQuery. " where $filter";
		}
		 $strQuery;*/
		return $this->query($strQuery);		
	}
    function updatePool($boolean,$poolid,$mode){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="update carpool set isJoined=$boolean, paymentMode='$mode' where poolid=$poolid";
			return $this->query($strQuery);
		}
	function addimage($image,$location,$description){
			$strQuery="insert into news set location='$location',description='$description',image='$image'";
			return $this->query($strQuery);
		}
}
?>