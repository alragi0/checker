<?php
if(strpos($message, '!gen') === 0 or strpos($message, '/gen') === 0 or strpos($message, '.gen') === 0){
sendaction($chatId, typing);
$sss = reply_to($chatId,$message_id,$keyboard,"<b>Generating</b>");
   $respon = json_decode($sss, TRUE);
            $message_id_1 = $respon['result']['message_id'];
	$lista = substr($message, 5);
	$lista = clean($lista);
$cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
$mon = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
$year = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
$amou = multiexplode(array(":", "/", " ", "|", ""), $lista)[4];
	$cards = [];
	$cc1 = substr($cc, 0, 1);
	$bin = substr($message, 5);
	$flag = 'getFlags';
	$cvvlength = strlen($cvv);
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://bins.su/');
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_POST, 1);
    $headers = array();
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Host: bins.su';
    $headers[] = 'Origin: http://bins.su';
    $headers[] = 'Referer: http://bins.su/';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=searchbins&bins='.$bin.'&bank=&country=');
$result = curl_exec($ch);
    $bincap1 = trim(strip_tags(getStr($result, '<td>Bank</td></tr><tr><td>','</td>')));
    $bincap2 = (getStr($result, '<td>'.$bincap1.'</td><td>','</td>'));
    $bincap3 = trim(strip_tags(getStr($result, '<td>'.$bincap2.'</td><td>','</td>')));
    $bincap4 = trim(strip_tags(getStr($result, '<td>'.$bincap3.'</td><td>','</td>')));
    $bincap5 = trim(strip_tags(getStr($result, '<td>'.$bincap4.'</td><td>','</td>')));
    $roldex = trim(strip_tags(getStr($result, '<td>'.$bincap5.'</td><td>','</td>')));
	if(empty($lista)){
	$response = urlencode("<b>VALID INPUT PLEASE \n Ex: <code>!gen 407544|xx|xx|xxx</code></b>");
	  edit_message($chatId,$message_id_1,$keyboard,$response);
	exit();
	}
	// if(strlen($cc) >12){
	 // $valid = "";
	  // $response = urlencode("<b>MAXIMUM BIN LENGTH ALLOWED IS 12\n I AM REMOVE LAST 4 DIGIT AND RANDOMISING IT.</b>");
	  // edit_message($chatId,$message_id_1,$keyboard,$response);
	  // $cc = strlen($cc,0,12);
	// }
	if($mon > 12){
	   $valid = '';
	   $response = urlencode("<b>INVALID MONTH</b>");
	  edit_message($chatId,$message_id_1,$keyboard,$response);
	exit();
	}
	if($year > 2029) {
	   $valid = '';
	   $response = urlencode("<b>MAXIMUM YEAR SUPPORTED IS 29</b>");
	  edit_message($chatId,$message_id_1,$keyboard,$response);
	exit();
	}
	// sendMessage($chatId,$keyboard,$noregister);
	if(empty($amou)){
	$amou = '10';
	}
$quantity = $amou;
	for($i = 0; $i < $quantity; $i ++){
			$bin = substr($cc, 0, 12);
			
			$digits = 16 - strlen($bin);
			$ccrem = substr(str_shuffle("0123456789"), 0, $digits);
			if($mon == 'xx' or $mon == 'x'){
				$monthdigit = rand(1,12);
			  }
			  else if (empty($mon)){
			  $monthdigit = rand(1,12);
			  }
			  else{
				$monthdigit = $mon;
			  }
			  
			if (strlen($monthdigit) == 1){
				$monthdigit = "0".$monthdigit;
			}

			  if($year == 'xxxx' or $year == 'xxx' or $year == 'xx' or $year == 'x'){
			  $yeardigit = rand(2023,2029);
			  }
			  else if (empty($year)){
			  $yeardigit = rand(2023,2029);
			  }
			  else{
			  $yeardigit = $year;
			  }
			  
			  if($cvv == 'x' or $cvv == '' or $cvv == 'xx' or $cvv == 'xxx'){
				  if($cc1 == 3){
					 $cvvdigit =rand(1000,9999);
			  }
		  else if (empty($cvv)){
					   $cvvdigit = rand(100,999);
			  }
			  }
			  else {
				$cvvdigit = $cvv;
			  }
			$ccgen = $bin.$ccrem;
			
			$cards[]= ''.$ccgen.'|'.$monthdigit.'|'.$yeardigit.'|'.$cvvdigit.'';
			$cards[]= "\n";
		}
		$card = implode ($cards);
		if(empty($mon)){
		$mon = 'x';
		}
		if(empty($year)){
		$year = 'x';
		}
		if(empty($cvv)){
		$cvv = 'x';
		}
$respo = 	urlencode("<b>• 𝗖𝗖 𝗚𝗘𝗡𝗘𝗥𝗔𝗧𝗢𝗥 𝄵
• 𝗕𝗜𝗡 ⇾ <code>$bin</code>
• 𝗔𝗺𝗼𝘂𝗻𝘁 ⇾ <code>10</code>

<code>$card</code>
• 𝗕𝗮𝗻𝗸 : $roldex
• 𝗖𝗼𝘂𝗻𝘁𝗿𝘆 : $bincap2 {$flag($bincap2)}
• 𝗚𝗘𝗡 𝗕𝗬 ‌: @$username
• 𝗕𝗢𝗧 𝗕𝗬 ‌: @YYNXX</b>");
		edit_message($chatId,$message_id_1,$keyboard,$respo);
}

?>