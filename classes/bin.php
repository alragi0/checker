<?php
if(strpos($message, '!bin') === 0 or strpos($message, '/bin') === 0 or strpos($message, '.bin') === 0){
sendaction($chatId, typing);
$flag = 'getFlags';
$bin = substr($message, 5);
$bin = clean($bin);
$bin = substr($bin, 0,6);
if(empty ($bin)){
    reply_to($chatId, $message_id,$keyboard,"[ALERT] <i>GIVE ME VALID BIN</i>");
    exit();
}elseif(strlen($bin < 6)){
    reply_to($chatId, $message_id,$keyboard,"[ALERT] <i>GIVE ME VALID BIN</i>");
        exit();
}
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
// $flag = getFlags($bincap2);
    if(strpos($result, 'No bins found!')) {
    reply_to($chatId,$message_id,$keyboard, "<b>❌BIN BANNED</b>");
    exit();
    }
$binresult = urlencode("<b>═════ 『 𝗔𝗹𝗿𝗮𝗴𝗶 † 』════

𝗩𝗔𝗟𝗜𝗗 𝗕𝗜𝗡 ✅
𝗕𝗜𝗡 ⇾ <code>$bin</code>
𝗕𝗿𝗮𝗻𝗱 : $bincap3
𝗟𝗲𝘃𝗲𝗹 : $bincap4
𝗕𝗮𝗻𝗸 : $roldex
𝗖𝗼𝘂𝗻𝘁𝗿𝘆 : $bincap2 {$flag($bincap2)}
𝗧𝘆𝗽𝗲  : $bincap5
𝘾𝙃𝙀𝘾𝙆𝙀𝘿 𝘽𝙔 ⇾ @$username </b>");
    reply_to($chatId, $message_id,$keyboard,$binresult);
        exit();
}
?>