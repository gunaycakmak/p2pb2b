<?php
	$zaman=microtime(true)*1000;
	$zamanlar=explode(".",$zaman);
	
	$balance = [
		'currency' => 'MPG',  //coin symbol
        'request' => '/api/v1/account/balance', // api request
        'nonce' => $zamanlar[0]/1  // server time 13 dig. (now)
    ];
	
	$balanceJson = json_encode($balance, JSON_UNESCAPED_SLASHES);
	
	$apiKey = 'YOUR-API-KEY';
    $apiSecret = 'YOUR-SECRET-KEY';
	
    $payload = base64_encode($balanceJson);	
    $signature = hash_hmac('sha512', $payload, $apiSecret);

	$Dizi=array(
		"Content-Type: application/json",
		"X-TXC-APIKEY: ".$apiKey,
		"X-TXC-PAYLOAD: ".$payload,
		"X-TXC-SIGNATURE: ".$signature
	);
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://p2pb2b.io/api/v1/account/balance",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => false,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS =>$balanceJson,
	  CURLOPT_HTTPHEADER => $Dizi
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response."<br>";

} 
?>

       
