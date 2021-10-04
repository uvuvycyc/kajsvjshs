<?php


function bot($method, $datas = []) {
$token = "1973941290:AAHJo7hvXIdlJF7KUKCneLCmBjvtnzKhC5s";//توكن
$url = "https://api.telegram.org/bot$token/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
curl_close($ch);
return json_decode($res, true);
}
function getupdates($up_id) {
$get = bot('getupdates', ['offset' => $up_id]);
return end($get['result']);
}


$id = "1078349914";


while (1) {
	
	
$get_up = getupdates($last_up + 1);
$last_up = $get_up['update_id'];
if ($get_up) {
	$message = $get_up['message'];
	$mid = $get_up['message']['message_id'];
	$userID = $message['from']['id'];
	$chat_id = $message['chat']['id'];
	$firstname = $message["from"]["first_name"]; 
     $text = $message['text'];
     


if($text == '/start'){




bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"Hey $firstname \nUse !bin xxxxxx to Check BIN \n .BY  @AKIL828"]);
         } //Bin Lookup
         
         
 if(strpos($text, "!bin") === 0){ 
 $bin = substr($text, 5); 
 $curl = curl_init();
 curl_setopt_array($curl, [ CURLOPT_URL => "https://bins-su-api.vercel.app/api/".$bin, 
 CURLOPT_RETURNTRANSFER => true, 
 CURLOPT_FOLLOWLOCATION => true, 
 CURLOPT_ENCODING => "", 
 CURLOPT_MAXREDIRS => 10, 
 CURLOPT_TIMEOUT => 30, 
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
 CURLOPT_CUSTOMREQUEST => "GET", 
 CURLOPT_HTTPHEADER => [ "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", "accept-language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7", "sec-fetch-dest: document", "sec-fetch-site: none", "user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1" ], 
 ]); 
 $result = curl_exec($curl); 
 curl_close($curl); 
 file_put_contents("V1", $result);
 $data = json_decode($result, true); 
  $bank = $data['data']['bank']; 
   $akil = $data['data']['bin']; 
  $country = $data['data']['country']; 
 $brand = $data['data']['vendor']; 
 $level = $data['data']['level']; 
 $type = $data['data']['type']; 
 $result1 = $data['result']; 
 if ($result1 == true) { 
 bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"✅ Bin: $akil
          
          LEVEL : $level
          COUNTRY : $country
          TYPE : $type
          BRAND : $brand
          Bank Name : $bank
          
         
         
         Checked By @AKIL828 "]); 
 }else { 
 bot('sendMessage',[
        'chat_id'=>$chat_id,
         'text'=>"Enter Valid BIN"]);}} 
 
}

}
  
