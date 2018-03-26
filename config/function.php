<?php
	require("constant.php");
	
	function logout()
	{
		 $_SESSION = array();
        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }
        // destroy session
        session_destroy();
	}
	

	
	function redirect($page)
	{
		header("Location: http://localhost/middleware/$page");
		exit;
	}
	
	function create_error_response($response_type, $response_message){
		$response = array('type' => $response_type, 'res'=>$response_message);
		echo json_encode($response);
	}
	

?>