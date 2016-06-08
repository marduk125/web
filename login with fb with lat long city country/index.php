<?php
include_once("config.php");
include_once("includes/functions.php");
//destroy facebook session if user clicks reset
if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>'public_profile,user_photos'));
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}else{
	$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture,location{location}');

	$facebook_location = $user_profile['location{location}']['location']['city'];
    $facebook_city_country = $facebook_location['name'];
    $city_country=explode(',',$facebook_city_country); $city=$city_country[0]; 
	$city=$city_country[0];
	$country=$city_country[1];

	$user = new Users();
	$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	if(!empty($user_data)){
		$output = '<h1>Facebook Profile Details </h1>';
		$output .= '<img src="'.$user_data['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
        $output .= '<br/>Name : ' . $user_data['first_name'].' '.$user_profile['last_name'];
        $output .= '<br/>Email : ' . $user_data['email'];
        $output .= '<br/>Gender : ' . $user_data['gender'];
        $output .= '<br/>Locale : ' . $user_data['locale'];
       
        $output .= '<br/>City : ' . $user_profile['location']['location']['city'];
        $output .= '<br/>Country : ' . $user_profile['location']['location']['country'];
        $output .= '<br/>Latitude : ' . $user_profile['location']['location']['latitude'];
        $output .= '<br/>Longitude : ' . $user_profile['location']['location']['longitude'];
        /// $output .= '<br/>Country : ' . $country;

        $output .= '<br/>You are login with : Facebook';
        $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>'; 
        
        
        
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Facebook using PHP by CodexWorld</title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
</style>
</head>
<body>
<div>
<?php echo $output; ?>
</div>

</body>
</html>