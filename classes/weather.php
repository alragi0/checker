<?php
if(strpos($message, '!weather') === 0 or strpos($message, '/weather') === 0 or strpos($message, '.weather') === 0){
sendaction($chatId, typing);
$link = mysqli_connect("localhost", "u760616334_yynxx", "08550855Mn##", "u760616334_alragi");
$sql = "SELECT credits FROM persons WHERE userid='$gId'";
$result = mysqli_query($link, $sql);

$json_array = [];


while ($row = mysqli_fetch_assoc($result)) {
  $json_array[] = $row;
}

$final2 = json_encode($json_array);

$client = trim(strip_tags(getStr($final2, '"credits":"','"')));
mysqli_close($link);
if(empty($client)){

 reply_to($chatId,$message_id,$keyboard,$noregister);
 exit();
}
$location = substr($message, 9);
if(empty($location)){
reply_to($chatId,$message_id,$keyboard,"<b>GIVE ME A CITY NAME %0AEX: <code>!weather Bokaro</code></b>");
exit();
}
$weatherToken = "89ef8a05b6c964f4cab9e2f97f696c81"; ///get api key from openweathermap.org

   $curl = curl_init();
   curl_setopt_array($curl, [
CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?q=$location&appid=$weatherToken",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 50,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"Accept: */*",
        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8,hi;q=0.7",
        "Host: api.openweathermap.org",
        "sec-fetch-dest: empty",
		"sec-fetch-site: same-site"
  ],
]);


$content = curl_exec($curl);
curl_close($curl);
$resp = json_decode($content, true);

$weather = $resp['weather'][0]['main'];
$description = $resp['weather'][0]['description'];
$temp = $resp['main']['temp'];
$humidity = $resp['main']['humidity'];
$feels_like = $resp['main']['feels_like'];
$country = $resp['sys']['country'];
$name = $resp['name'];
$kelvin = 273;
$celcius = $temp - $kelvin;
$feels = $feels_like - $kelvin;
$weatherresult = urlencode("<b>═════ 『 𝗔𝗹𝗿𝗮𝗴𝗶 † 』════
Weather at $location: $weather
Status: $description
Temp : $celcius °C
Feels Like : $feels °C
Humidity: $humidity
Country: $country 
Checked By: @$username </b>");
if ($location = $name) {
        reply_to($chatId,$message_id,$keyboard,$weatherresult);
}
else {
           reply_to($chatId,$message_id,$keyboard, "<b>Sorry! %0AGive Me Valid City Name %0AEX: <code>!weather Bokaro</code></b>");
}
    }

?>
