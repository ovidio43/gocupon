<?php 
/*
* template name: thank you
*
*/
?>

<?php
$merges = array('FNAME'=>$_POST['FNAME']);
$apiKey = '7f93d190326b76e9628023311a522109-us10';
$listId = 'd176da0ee2';
$double_optin=false;
$send_welcome=false;
$email_type = 'html';
$email = $_POST['EMAIL'];
//replace us2 with your actual datacenter
$submit_url = "http://us10.api.mailchimp.com/1.3/?method=listSubscribe";
$data = array(
'email_address'=>$email,
'apikey'=>$apiKey,
'merge_vars' => $merges,
'id' => $listId,
'double_optin' => $double_optin,
'send_welcome' => $send_welcome,
'email_type' => $email_type
);
$payload = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $submit_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
$result = curl_exec($ch);
curl_close ($ch);
$data = json_decode($result);
if ($data->error){
echo $data->error;
} else {
echo "THANKS!";
} 
?>
