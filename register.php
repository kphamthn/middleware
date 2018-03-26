<?php
	require("config/config.php");
	
	 if($_SERVER['REQUEST_METHOD']=="POST"){
	    $json = file_get_contents('php://input');
	    $data = json_decode($json, true);
	    if(validate_user($data)){
		 add_user($data, $client);
	    }
	}
	
?>

<?php
	function validate_user($data){
		 if(empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['password_confirm']) ){
			create_error_response('error', 'Please enter all fields');
			return false;
		 }
		 
		 if ( $data['password_confirm'] != $data['password']){
			create_error_response('error', 'Passwords do not match.');
			return false;
		 }
		 
		 if ( strlen( $data[ 'username' ] ) <= 2 ){
			create_error_response('error', 'Username must have maximal 3 characters.');
			return false;
		 }
		 if (!preg_match("/^[a-zA-Z ]*$/",$data[ 'username' ])) {
			create_error_response('error', 'Only letters and white space allowed');
			return false;
		}
		if(!preg_match("(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)", $data['email'])){
			create_error_response('error', 'Wrong email format');
			return false;
		}
		return true;
		
	}
	
	function add_user($data, $client){
		$new_doc = new stdClass();
		$new_doc->username = $data["username"];
		$new_doc->password = $data["password"];
		$new_doc->email = $data["email"];

		try {
		    $response = $client->storeDoc($new_doc);
		} catch (Exception $e) {
		    create_error_response('error', "ERROR: ".$e->getMessage()." (".$e->getCode().")");
			return;
		}
		echo  create_error_response('ok', $response->id); 
	}
	
?>