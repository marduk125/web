<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '1537689699894246'; //Facebook App ID
$appSecret = '917d9c07eb79279864f427c5493a9b06'; // Facebook App Secret
$homeurl = 'http://localhost/fb/index.php';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>