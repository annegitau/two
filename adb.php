<?php

class adb{
	var $db=null;
	var $result=null;
	function adb(){
	}
	/**
	*Connect to database 
	*@return true if connected or false otherwise
	*/
	function connect(){		
		//connect
		$this->db=new mysqli('localhost','root','','carproject');
		if($this->db->connect_errno){
			return false;
		}
		return true;
		}	
	/**
	*Query the database 
	*@param strQuery to query the database
	*/
	function query($strQuery){
		if(!$this->connect()){
			return false;
		}
		if($this->db==null){
			return false;
		}
		$this->result=$this->db->query($strQuery);
		if($this->result==false){
			return false;
		}
		return true;
	}
	/*
	* Fetch from the database
	*@return false if no data is in the data set
	*/
	function fetch(){
		if($this->result==null){
			return false;
		}
		
		if($this->result==false){
			return false;
		}
		
		return $this->result->fetch_assoc();
	}
}

?>