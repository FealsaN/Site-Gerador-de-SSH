<?php

//by twossh



require('config.php');


$conn = new mysqli($sql_host, $sql_user, $sql_pass, $sql_name);
$conn->set_charset("utf8");

session_start();

$ip = $_SERVER['REMOTE_ADDR'];
$query_ip = $conn->query("SELECT * FROM `sshfree` WHERE ip='$ip'");

$c = $conn->query("SELECT * FROM `conf` WHERE 1");




while($ds = $c->fetch_array()){
	
	$conf[$ds['id']] = array(
	
        "com" => $ds['com']
	
	);
}




if($query_ip->num_rows >= 1){
	
	$fetchAdd = $query_ip->fetch_array(MYSQLI_ASSOC);
	
	$_SESSION['id'] = $fetchAdd['id'];
}else{
	
	unset($_SESSION['id']);
}

if(isset($_SESSION['id'])){
	
	if(currentTimeW($_SESSION['id']) == "ok"){
		unset($_SESSION['id']);
	}
}




function serves($server){
	global $conn;
	
	$query = $conn->query("SELECT * FROM `serves` WHERE server='$server'");
	
	if($query->num_rows < 1){
		
		return "notserver";
	}
	
	while($row = $query->fetch_array()){
		
		$array = array(
		"server" => $row['id'],
		"ip" => $row['ip'],
		"pass" => $row['pass']
		);
	}
	
	return $array;
}

function currentTimeW($id){
	
	global $conn, $conf;
	$c = "ok";
	
	 $secs = 3600 * $conf[3]['com'];
	 
	$query = $conn->query("SELECT * FROM `sshfree` WHERE id='$id'");
	
	
	
		
		$fetch = $query->fetch_array(MYSQLI_ASSOC);
		
	foreach($conn->query("SELECT TIMESTAMPDIFF(SECOND, '$fetch[tempo]', CURRENT_TIMESTAMP())") as $times){
							
	 $sec = $times["TIMESTAMPDIFF(SECOND, '$fetch[tempo]', CURRENT_TIMESTAMP())"];
	 
	 
	 }
	

	 
	 
	 
	 	    $time = $sec;
            $time = intval($time);
            $required = intval($secs);
            $time_left = ($required-$time);
             
			
			if($time >= $secs){
				
				return $c;
				
			}else{
				
				return $time_left;
			}
	
	
}






	
