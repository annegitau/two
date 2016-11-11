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
	/**
	*Adds a new user
	*@param string username login name
	*@param string firstname first name
	*@param string lastname last name
	*@param string password login password
	*@param string usergroup group id
	*@param int permission permission as an int
	*@param int status status of the user account
	*@return boolean returns true if successful or false 
	*/
	function addPool($poolid,$location,$destination,$poolstatus=){
		$strQuery="insert into pool set
						poolid='$poolid',
						location='$location',
						destination='$destination',
						poolstatus=$poolstatus";
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
	
	function editPool($poolid,$location,$destination){
		$strQuery="update users set
						poolid='$poolid',
						location='$location',
						destination='$destination' where poolid=$poolid";
						echo "User Edited";
		return $this->query($strQuery);				
	}
	
	function updateStatus($poolid,$poolstatus){
			$user=strcmp("OPEN", $poolstatus);
			if($user==0){
				$strQuery="UPDATE pool set poolstatus='OPEN' WHERE poolid=$poolid";
			}
			else{
				$strQuery="UPDATE pool set STATUS='CLOSED' WHERE poolid=$poolid";
				}
				echo "Status Updated";
		 return $this->query($strQuery);
	}
	
	function deleteUser($usercode){
		$strQuery= "delete from pool where poolid='$poolid'";
		echo "User Deleted";
		return $this->query($strQuery);
		
	}
}
?>