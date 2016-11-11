<!DOCTYPE html>

<?php
define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_NAME","carproject");

$username="";
$firstname="";
$lastname="";
$password="";
$pnumber="";
$status="DISABLED";

if(isset($_REQUEST['username'])){
    $username=$_REQUEST['username'];
    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $pnumber=$_REQUEST['pnumber'];
    
    include_once("users.php");
    $obj=new users();
    $r=$obj->addUser($username,$firstname,$lastname,$email,$pnumber,$password,$usergroup);
    //chek whether the data has been added or not
    if(!$r==false)
        echo $username + "added";
    //$strStatusMessage=$username+"added";
    else
        echo "error adding user";
    //$strStatusMessage="error while adding user";
}
$username="";
$firstname="";
$lastname="";
$password="";
$pnumber="";
$status="DISABLED";
?>
<?php 
$poolid ="";
$location="";
$destination="";
$poolstatus="OPEN";
$price="";
if(isset($_REQUEST['poolid'])){
    $poolid=$_REQUEST['poolid'];
    $location=$_REQUEST['location'];
    $destination=$_REQUEST['destination'];
    $price=$_REQUEST['price'];
    
    include_once("users.php");
    $obj=new users();
    $r=$obj->addPool($poolid,$location,$destination,$price);
    
    if(!$r==false)
        echo $poolid + "Created";
    else
        echo "Error creating a pool";
}
$poolid="";
$location="";
$destination="";
$poolstatus="OPEN";
$price="";
?>
<html>
    <head>
		<meta charset="utf-8">
		<title>CAR POOL</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" />

		<link rel="stylesheet"  href="css/jquery.mobile.structure.css" />
		<link rel="stylesheet" href="css/jquery.mobile.theme.css" />
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        

		<script>
			var userAgent = navigator.userAgent + '';
			if (userAgent.indexOf('iPhone') > -1) {
				document.write('<script src="js/lib/cordova-iphone.js"></sc' + 'ript>');
				var mobile_system = 'iphone';
			} else if (userAgent.indexOf('Android') > -1) {
				document.write('<script src="js/lib/cordova-android.js"></sc' + 'ript>');
				var mobile_system = 'android';
			} else {
				var mobile_system = '';
			}
		</script>
        <script>
            var currentObject=null;//variable to pass new users
		/*
		Checking the status of function and giving the appropriate bfeedback
		*@param xhr
		*@param status
		*/
		function addUserComplete(xhr,status){
			var response = $.parseJSON(xhr.responseText);
				if(status!="success"){
					alert('Unable to Add User')
				}
				if(response.result==0){
					alert(response.message);
				}
			else{
				alert(response.message);
				header('Location:login/interface.php');
			}
		}
			function addUser(user){
				var ajaxPageUrl="usersajax.php?cmd=1&username="+user;
				$.ajax(ajaxPageUrl,
				{
					async:true,
					complete:addUserComplete	
					}	
				);
			}		
        </script>

		<script src="js/lib/jquery.js"></script>
		<!-- your scripts here -->
		<script src="js/app/app.js"></script>
		<script src="js/app/bootstrap.js"></script>
		<script src="js/lib/jquery.mobile.js"></script>
        <script type="text/javascript" src="myScript.js" ></script>
        <script type="text/javascript">
		var currentObject=null;//variable to pass new users
		/*
		Checking the status of function and giving the appropriate bfeedback
		*@param xhr
		*@param status
		*/
		function addUserComplete(xhr,status){
			var response = $.parseJSON(xhr.responseText);
				if(status!="success"){
					alert('Unable to Add User')
				}
				if(response.result==0){
					alert(response.message);
				}
			else{
				alert(response.message);
				header('Location:login/interface.php');
			}
		}
			function addUser(user){
				var ajaxPageUrl="usersajax.php?cmd=1&username="+user;
				$.ajax(ajaxPageUrl,
				{
					async:true,
					complete:addUserComplete	
					}	
				);
			}
		    var pass = <?php echo json_encode($_SESSION['password']) ?>;
        var timeout = setTimeout("location.reload(true);",6000000);

        function resetTimeout() {
        clearTimeout(timeout);
        timeout = setTimeout("location.reload(true);",30);
         }

         function hashCode(str){  
            var arr1 = [];  
            for (var n = 0, l = str.length; n < l; n ++)   
            {  
            var hex = Number(str.charCodeAt(n)).toString(16);  
            arr1.push(hex);  
            }  
          return arr1.join('');  
       }
        //get active pools data
          function getTableData(poolid){
            resetTimeout();
            var tableID = [];
            var transPort = [];
            var theTable = document.getElementById('ThirdTable');
            if (theTable != null) {
            for (var i = 1; i < theTable.rows.length; i++) { 
                    tableID[i] = theTable.rows[i].cells[0].innerHTML;
                    if(poolid==tableID[i]){
                      transPort[0] = theTable.rows[i].cells[2].innerHTML; // state
                      transPort[1] = theTable.rows[i].cells[4].innerHTML; // departure
                      transPort[2] = theTable.rows[i].cells[5].innerHTML; // charges
                      transPort[3] = theTable.rows[i].cells[6].innerHTML; // owner
                      return transPort;

                    }else{
                    alert("This pool does not exist!");
                }

              }
         }
         alert("Check Available pools first!");
         
     }
     // Show location on Google map
           function Map(location){
             NewWindow = window.open("map.html", "SalesDetails","resizable,scrollbars,status");
             NewWindow.document.write("<html><body>");
             NewWindow.document.write("<div style='height:500px;width:500px;max-width:100%;list-style:none; transition: none;overflow:hidden;'><div id='display-google-map' style='height:100%; width:100%;max-width:100%;'><iframe style='height:100%;width:100%;border:0;' frameborder='0' src='https://www.google.com/maps/embed/v1/place?q="+location.innerHTML+"&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU'></iframe></div><a class='embed-map-html' rel='nofollow' href='http://www.interserver-coupons.com' id='enable-map-data'>http://www.interserver-coupons.com</a><style>#display-google-map .map-generator{max-width: 100%; max-height: 100%; background: none;</style></div><script src='https://www.interserver-coupons.com/google-maps-authorization.js?id=5cf9e445-fbbf-5422-531c-95b03e0a4f9d&c=embed-map-html&u=1478760918' defer='defer' async='async'>");
             NewWindow.document.write("</body>");
             NewWindow.document.write("</html>");
           }

           // Retrived your own pools
           function RetrievedData(){
              var url="createPool.php?cmd=2&password="+hashCode(pass);
              var obj=$.ajax(url, {async:true,complete:RetrievedDataComplete});
          }
                     
         function RetrievedDataComplete(xhr,status){
        	    if(status!="success"){
        	    alert("error while creating pool");
        	    return;
                }
                var obj=JSON.parse(xhr.responseText);
                if(obj.result==0){
					 return window.alert(obj.message);

				}else{
					
  				var table="<table><th>PoolID</th><th>Pool</th><th>Members</th><th>Contact</th><th>Departure</th><th>Destination</th><th>ChargesGHC</th><th>PayMode</th><th>Delete</th>";
					var EditNote = "<b style='color:white'>**Click on any Pool ID to edit</b>";
          var counter=0;

                    while(counter<obj.user.length){
                    table+="<tr><td>"+obj.user[counter].Pool_ID+"</td><td>"+obj.user[counter].Pool_Name+"</td><td>"+obj.user[counter].Member_Name+"</td><td><a href=tel:"+obj.user[counter].Member_Contact+">" +obj.user[counter].Member_Contact+"</td><td>"+obj.user[counter].Departure+"</td><td>"+obj.user[counter].Destination+"</td><td>"+obj.user[counter].Pool_Charges+"</td><td>"+obj.user[counter].Mode_Of_Pay+"</td><td><button style='background:none';'border:none;' onClick=DeleteMember("+obj.user[counter].Member_Contact+")"+"/button>"+"Delete"+"</td></tr>";
                      counter++;  
                } 
                table+="</table>";             
                document.getElementById("ViewPoolTable").innerHTML=table;
                document.getElementById("EditNote").innerHTML=EditNote;

                var theTable = document.getElementById('ViewPoolTable');
         		if (theTable != null) {
        		  for (var i = 1; i < theTable.rows.length; i++) { 
         		     for (var j = 0; j < 9; j++){
              	     if(theTable.rows[i].cells[j]==theTable.rows[i].cells[0]){
                	    theTable.rows[i].cells[j].onclick = function () {EditPool(this);};
                	  }else{
                	  }
              	 	 }
            	  }
        		 }
           }
        }

          function EditPool(poolID){
             var theUrl="createPool.php?cmd=6&poolid="+poolID.innerHTML+"&password="+hashCode(pass);
             $.ajax(theUrl, {async:true,complete:EditPoolComplete});
             alert("loading..."+poolID.innerHTML);

           function EditPoolComplete(xhr,status){
           		if(status!="success"){
        	    alert("error while retrieving pool");
        	    return;
                }
                alert(xhr.responseText);
                var obj=JSON.parse(xhr.responseText);
                
                if(obj.result==0){
					      return window.alert(obj.message);
					}else{
						var table="<table><th>PoolID</th><th>PoolName</th><th>Departure</th><th>Destination</th><th>ChargesGHC</th><th>SaveChanges</th>";
						var counter=0;
						var EditNote="<b style='color: while'>**Click on particular pool ID's details to edit</b>";
				    while(counter<obj.user.length){
            	table+="<tr><td id='poolid'>"+(obj.user[counter].Pool_ID)+"</td><td id='poolname' contenteditable='true'>"+obj.user[counter].Pool_Name+"</td><td id='departure'contenteditable='true'>"+obj.user[counter].Departure+"</td><td id='destination' contenteditable='true'>"+obj.user[counter].Destination+"</td><td id='Pool_Charges' contenteditable='true'>"+obj.user[counter].Pool_Charges+"</td><td><button type ='button' style='background:none';'border:none;' onClick=\"UpdatePool("+document.getElementById('poolid').value+","+"'"+document.getElementById('poolname').value+"'"+","+"'"+document.getElementById('departure').value+"'"+","+"'"+document.getElementById('destination').value+"'"+","+document.getElementById('Pool_Charges').value+")\">Save</button></td></tr>";  

            	counter++;
          	}
        		table+="</table>";
        		
        		document.getElementById("ViewPoolTable").innerHTML=table;
        		document.getElementById("EditNote").innerHTML=EditNote;

			 }
    }
           // Pool all active pools
           function RetrievedPools(){
              var url="createPool.php?cmd=3";
              var obj=$.ajax(url, {async:true,complete:RetrievedPoolsComplete});
          }
           function RetrievedPoolsComplete(xhr,status){
        	    if(status!="success"){
        	    alert("error while retrieving pool");
        	    return;
                }
                var obj=JSON.parse(xhr.responseText);
                if(obj.result==0){
					     return window.alert(obj.message);

				      }else{
					     var table="<table><th>Pool ID</th><th>Pool</th><th>Members</th><th>Destination</th><th>Departure</th><th>Charges GHC</th><th>Owner</th><th>Contact</th><th>Location</th>";
                	var counter=0;
                    while(counter<obj.user.length){
                    table+="<tr><td>"+obj.user[counter].Pool_ID+"</td><td>"+obj.user[counter].Pool_Name+"</td><td>"+obj.user[counter].state+"</td><td>"+obj.user[counter].Destination+"</td><td>"+obj.user[counter].Departure+"</td><td>"+obj.user[counter].Pool_Charges+"</td><td>"+obj.user[counter].Pool_Owner_Firstname+"</td><td><a href=tel:"+obj.user[counter].Owner_Phone_Number+">" +obj.user[counter].Owner_Phone_Number+"</td><td>"+obj.user[counter].Owner_Location+"</td></tr>";
                      counter++;  
                } 
                table+="</table>";             
                document.getElementById("ThirdTable").innerHTML=table;
              }

              var theTable = document.getElementById('ThirdTable');
              if (theTable != null) {
              for (var i = 1; i < theTable.rows.length; i++) { 
                 for (var j = 0; j < 9; j++){
                   if(theTable.rows[i].cells[j]==theTable.rows[i].cells[8]){
                    theTable.rows[i].cells[j].onclick = function () {Map(this);};
                  }else{
                  }
                }
              }
         }
      }
           //Update a pool
           function UpdatePool(poolID,poolname,departure,destination,PoolCharges){
           	alert(poolID,poolname,departure,destination,PoolCharges);
           	var url="createPool.php?cmd=7&poolid="+poolID+"&poolname="+poolname+"&departure="+departure+"&destination="+destination+"&pay="+PoolCharges+"&password="+hashCode(pass);
         		    var obj=$.ajax(url, {async:true,complete:UpdatePoolComplete});
         		    alert(url);
           		}
              function UpdatePoolComplete(xhr, status){
              if(status!="success"){
              alert("error while updating pool");
              return;
                }
                alert(xhr.responseText);
                resetTimeout();
           }

              //Create a pool
         	function TakeData(password,poolname,yourname,phonenumber,location,pay,departure,destination){	
         		if((poolname.value=="") || (yourname.value=="")|| (phonenumber.value=="")|| (location.value=="")|| (yourname.value=="")|| (pay.value=="")|| (departure.value=="")|| (destination.value=="")){
					         return alert("Fill the empty field(s)");
				    }
				      var passCode = hashCode(pass);
				      var passValue = hashCode(password.value)

				     if(passCode!=passValue){
					   return alert("Password is incorrect!");
				    }
         		var url="createPool.php?cmd=1&poolname="+poolname.value+"&yourname="+yourname.value+"&phonenumber="+phonenumber.value+"&location="+location.value+"&pay="+pay.value+"&departure="+departure.value+"&destination="+destination.value+"&password="+passValue;
         		    var obj=$.ajax(url, {async:true,complete:TakeDataComplete});
         		    
          }
          function TakeDataComplete(xhr,status){
              if(status!="success"){
              alert("error while creating pool");
              return;
                }
                alert(xhr.responseText);                
           }

          //Delete Memeber
          function DeleteMember(phonenumber){
          		var url="createPool.php?cmd=5&phonenumber="+phonenumber;
          		var obj=$.ajax(url, {async:true,complete:DeleteMemberComplete});
          }
          function DeleteMemberComplete(xhr,status){
              if(status!="success"){
              alert("error while deleting member");
              return;
                }
                alert(xhr.responseText);    
                resetTimeout();            
           }

          //send SMS
          function SendMessage(phonenumber,sender,departure,charges){
            alert("Am here");
          	if((phonenumber=="") || (sender=="")){
					     return window.alert("Fill the empty field(s)");
				      }
				        phonenumber = phonenumber.replace(/;/g, '&number=');
				        if(charges==null){
				        message = departure;
			          }else{
			           message = "You have successfully join this pool, your departure time is: "+departure+ "and charges is GHC: "+charges;
			          }
          	     var url="home.php?cmd=1&number="+phonenumber+"&name="+sender+"&message="+message;
          	     var obj=$.ajax(url, {async:true,complete:SendMessageComplete});
                 alert(url);
          }
          function SendMessageComplete(xhr,status){
              if(status!="success"){
                 alert("error while sending message");
                 return;
                }
                alert(xhr.responseText);                
          }

     //Join pool an recieve notification
          function Join(poolid,yourname,phonenumber,location,pay){
          	if((poolid.value=="") || (yourname.value=="")|| (phonenumber.value=="")|| (pay.value=="")|| (location.value=="")){
					   return window.alert("Fill the empty field(s)");
				}
				//bring me charges and departure where entered poolid==poolid
				    var tableID = [];
				    tableID= getTableData(poolid.value);
				    if(tableID[0]>3){
				  	alert("This Pool is full");
				  	exit();
				}
          	var url="createPool.php?cmd=4&phonenumber="+phonenumber.value+"&yourname="+yourname.value+"&poolid="+poolid.value+"&pay="+pay.value+"&location="+location.value;
          	var obj=$.ajax(url, {async:true,complete:JoinComplete});
          	SendMessage(phonenumber.value,tableID[3],tableID[1],tableID[2]);	
          }

          function JoinComplete(xhr,status){
              if(status!="success"){
              alert("error while joining pool");
              return;
                }
                alert(xhr.responseText);                
           }
  }
		</script>
		<style>
			.ui-selectmenu.ui-popup .ui-input-search {
				margin-left: .5em;
				margin-right: .5em;
			}
			.ui-selectmenu.ui-dialog .ui-content {
				padding-top: 0;
			}
			.ui-selectmenu.ui-dialog .ui-selectmenu-list {
				margin-top: 0;
			}
			.ui-selectmenu.ui-popup .ui-selectmenu-list li.ui-first-child .ui-btn {
				border-top-width: 1px;
				-webkit-border-radius: 0;
				border-radius: 0;
			}
			.ui-selectmenu.ui-dialog .ui-header {
				border-bottom-width: 1px;
			}
			a {
				text-decoration: none;
			}
		</style>

	</head>
    <body>
        <div data-role="page" id="landingPage" style="background: white">
            <div data-role="header" style="text-shadow: none">
				<h1>Welcome</h1>
                <a href="#landingPage" data-role="button" data-icon="refresh" data-iconpos="notext" style="background: white;border: none;">Refresh</a>
				
            </div><!-- header -->
            <div data-role="content" style="text-shadow: none">
                <div style="background:white;color:black; text-align:center; font-weight:bolder; padding: 20px;box-shadow: 5px 5px 5px grey;">
                    <?php
function output_errors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}	
	$username="";
	$firstname="";
	$lastname="";
	$password="";
	$phonenumber="";
	
	//assinging inserted data to columns in the datanase table
	if(isset($_REQUEST['login'])){
		$username=$_REQUEST['username'];
		$firstname=$_REQUEST['firstname'];
		$lastname=$_REQUEST['lastname'];
        $phonenumber=$_REQUEST['phonenumber'];
		$password=$_REQUEST['password'];
		
		//creating an object for the class users.php
		//calling the method signup to add data to the database
		include_once("users.php");
		$obj=new users();
		$r=$obj->addUser($username,$firstname,$lastname,$password,$phonenumber);
		//chek whether the data has been added or not
		if($r==false){
					$strStatusMessage="error while adding user";
				}else{
					$strStatusMessage=$username+" added";
					echo " SIGN UP SUCCESSFUL";
					//header('Location:index.php');
				
				}
	
	$errors= array();
	if (empty($_POST) === false) {
		$required_fields = array('username','firstname','phonenumber','password');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields)===true){
				$errors[]='Fields marked with an * are required';
				break 1;
			}
		}
	}
	if (preg_match("/\\s/", $_POST ['username']) == true) {
    $errors[] = 'username must not contain any space. ';
   }
   if ( strlen($_POST['password'])< 6){
    $errors[] = 'Password must be more the 6 characters ';
   }
   

		
	if (empty($_POST) ===true && empty($errors) ===true ){
		//register user
	}else{
		echo output_errors($errors);
	}
	}
	
	$username="";
	$firstname="";
	$lastname="";
	$phonenumber="";
	
?>
                    <form class="login-form" action="">
                        <div class="imgcontainer">
                            <img src="img/logo.jpg">
                        </div>
                    <h5>WELCOME TO CAR POOLING!</h5>
                        <h6>Sign Up or <a href="#loginPage" data-transition="none">Login</a></h6>
                    
                        <div class="row margin">
                            <label>*</label>
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="username" class="validate" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"> 
                            </div>
                        </div>
                        <div class="row margin">
                            <label>*</label>
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="firstname" class="validate" type="text" name="firstname" placeholder="Firstname" value="<?php echo $firstname;  ?>">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="lastname" class="validate" type="text" name="lastname" placeholder="Lastname" value="<?php echo $lastname;  ?>">
                            </div>
                        </div>
                        <div class="row margin">
                            <label>*</label>
                            <div class="input-field col s8">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password" type="password" class="validate" placeholder="password" name="pword">
                            </div>
                        </div>
                        <div class="row margin">
                            <label>*</label>
                            <div class="input-field col s8">
                                <i class="mdi-communication-phone prefix"></i>
                                <input id="pnumber" class="validate" type="text" name="pnumber" placeholder="Phone number" value="<?php echo $pnumber;  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <a href="index.php" class="btn waves-effect waves-light col s12">Register Now</a>
                            </div>
                            <div class="input-field col s12">
                                <p class="margin center medium-small sign-up">Already have an account? <a href="#loginPage" data-transition="none">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- content -->
        </div><!-- Home page -->
            
        
        <div data-role="page" id="loginPage" style="background: white">
            <div data-role="header" style="text-shadow: none">
				<h1>Login</h1>
				<a href="#landingPage" data-role="button" data-icon="refresh" data-iconpos="notext" style="background: white;border: none;">Refresh</a>
            </div><!-- header -->
            <div data-role="content" style="text-shadow: none">
                <div style="background:white;color:black; text-align:center; font-weight:bolder; padding: 20px;box-shadow: 5px 5px 5px grey;">
                    <form action="">
                        <div class="imgcontainer">
                            <img src="img/logo.jpg">
                        </div>
                        
                        <div class="container">
                            <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="username" class="validate" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>"> 
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password" type="password" class="validate" placeholder="password" name="pword">
                            </div>
                        </div>
                            <a href="#homePage" type="submit" >Login</a>
                                <a href="#landingPage" class="btn waves-effect waves-light col s12">No Account? Register Now</a>
                         </div>
                    </form>
                    </div>
            </div><!-- content -->
        </div><!-- Login page -->
               
        <div data-role="page" id="homePage" style="background: white">
            <div data-role="header" style="text-shadow: none">
				<h1>Home</h1>
				<a href="#homePage" data-role="button" data-icon="refresh" data-iconpos="notext" style="background: white;border: none;">Refresh</a>                
                <a href="#NewsFeed" data-role="button"  style="background: white;border: none;">News Feed</a>
            </div><!-- header -->
            <div data-role="content" style="text-shadow: none">
                 <div style="background:white;color:#000099; text-align:center; font-weight:bolder; padding: 20px;box-shadow: 5px 5px 5px grey;">
                    <form action="">
                        <div class="imgcontainer">
                            <img src="img/logo.jpg">
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <a href="#createPool" class="btn waves-effect waves-light col s12">Make a New Pool</a>
                            </div>

                                                          <div class="container">
                            <h5>ALL POOLS</h5>
                                <div>
                                    <?php
                                    include_once("users.php");
                                    $obj=new users();
                                    
                                    echo "<table>
                                    <tr>
                                        <td>pool</td>
                                        <td>From</td>
                                        <td>To</td>
                                        <td>phonenumber</td>
                                        <td></td>
					                </tr>";
                                    
                                    while($row=$obj->fetch()){
                                        echo "<tr>";
                                        echo "<td>{$row['poolid']}</td>";
                                        echo "<td>{$row['location']}</td>";
                                        echo "<td>{$row['destination']}</td>";
                                        echo "<td>{$row['phonenumber']}</td>";
                                        echo "";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    ?>
                            </div>
                            <!-- results of available pool -->
                            <a href=# class="btn waves-effect waves-light col s4"  >JOIN POOL</a>
                        </div>
                                                  
				  	
                        </div>
                       
                    </form>
                     <form method="POST" action=""> 
			<center><h6>Send Notifications to Pool Members</h6></center>
               <p>
                <label><b>To</b></label>
                <input type="text" id="number" name="number" placeholder="number">
              </p>
              <p>
               <label><b>Sender</b></label> 
               <input type="text" id="sender" name="sender" placeholder="sender">
           </p>

            <p>
               <label for="b"><b>Message</b></label>
               <textarea rows="4" cols="50" id="message" name="message" placeholder="message"></textarea><br>
               <input id="sms.php" style="background-color: green" type="Submit" value="Send Message" onclick="SendMessage(number.value,sender.value,message.value,null)
                                                                                                  ">
           </p>        
        </form>
                    </div>
            </div><!-- content -->
        </div><!-- Home page -->
       
        <div data-role="page" id="createPool" style="background: white">
            <div data-role="header" style="text-shadow: none">
				<h1>Create Pool</h1>
				<a href="#landingPage" data-role="button" data-icon="refresh" data-iconpos="notext" style="background: white;border: none;">Refresh</a>
                <a href="#NewsFeed" data-role="button"  style="background: white;border: none;">News Feed</a>
            </div><!-- header -->
            <div data-role="content" style="text-shadow: none">
                <div style="background:white;color:#000099; text-align:center; font-weight:bolder; padding: 20px;box-shadow: 5px 5px 5px grey;">
                    <form action="">
                        <div class="imgcontainer">
                            <img src="img/logo.jpg">
                        </div>                        
                        <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input type="text" placeholder="Pool Id" value="<?php echo $poolid; ?>"> 
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input  type="text"  placeholder="Location" value="<?php echo $location;  ?>">
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input   type="text"  placeholder="Destination" value="<?php echo $destination;  ?>">
                            </div>
                        </div>
                        <div>
                        <a href="#homePage" class="btn waves-effect waves-light col s12">Add to Pool</a>
                        </div>
                         <div class="row margin">
                            <div class="input-field col s8">
                                <i class="mdi-social-person-outline prefix"></i>
                                <lable   type="text"  placeholder="Destination" >Price :<?php echo $price;  ?></lable>
                            </div>
                        </div>
                    </form>
                    </div>
                
            </div><!-- content -->
        </div><!-- Create Pool page -->
       
      <!--  <div data-role="page" id="checkPool" style="background: white">
            
            <div data-role="header" style="text-shadow: none">
				<h1>Check Pool</h1>
				<a href="#NewsFeed" data-role="button" data-icon="refresh" data-iconpos="notext" style="background: white;border: none;">Refresh</a>
                <a href="#NewsFeed" data-role="button"  style="background: white;border: none;">News Feed</a>
            </div><!-- header --
            <div data-role="content" style="text-shadow: none">
                <div style="background:white;color:#000099; text-align:center; font-weight:bolder; padding: 20px;box-shadow: 5px 5px 5px grey;">
                    <form action="">
                        <div class="imgcontainer">
                            <img src="img/logo.jpg">
                        </div>                        
                      
                        <div  class="container">
                            No pool for your destination? <br>
                        <a href=#createPool class="btn waves-effect waves-light col s4" >CREAT POOL!</a>
                        </div>
                    </form>
                    </div>
            </div><!-- content --
        </div><!-- Check pool page -->
        	<div data-role="page" id="NewsFeed">
			<div data-role="header" style="text-shadow: none; background: ">
				<h1>News Feed</h1>
				<a href="#homePage" data-role="button" data-icon="back" data-iconpos="notext" style="background: white;border: none;">Back</a>
			</div><!-- /header -->
			
			<div data-role="content" style="text-shadow: none">
				<div style="background: white;color:black; text-align:center; font-weight:bolder; padding: 10px;">
					What is on our Roads?
				 </div>
				<br />
                <div>
                            <a id="capturePhoto" onclick="return capturePhoto()" class="btn waves-effect waves-light col s12" >CAMERA</a>
                            <center><img class="lazy" style="display:none;width:100%;height:100%;" id="smallImage" src="" /></center>
                        </div>

			</div><!-- /content -->
		</div>
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script type="text/javascript" src="cordova.js"></script>
			<script type="text/javascript" src="scripts/platformOverrides.js"></script>
			<script type="text/javascript" src="js/index.js"></script>
    </body>
</html>