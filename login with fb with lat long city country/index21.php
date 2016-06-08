<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>




<?php
include_once("config.php");
include_once("includes/functions.php");
//destroy facebook session if user clicks reset
if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}else{
	$user_profile = $facebook->api( '/10205429809810393/notifications', 'POST', array(

                'template' => 'You have received a new message.',

                'href' => 'https://www.google.com',

                '1537689699894246917d9c07eb79279864f427c5493a9b06' => $app_access_token
            ) );    
	
print_r($response);
	}

	
?>
</body>
</html>