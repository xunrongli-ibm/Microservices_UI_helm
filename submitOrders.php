<?php

$data = file_get_contents('php://input');

$podHost = getenv("HOSTNAME");
#echo "\r\podHost:" . $podHost;
$pos = strpos($podHost, '-ui-');
$ordersHost = substr($podHost, 0, $pos) . "-orders-api";
$ordersRoute = "http://" . $ordersHost;
$ordersURL = $ordersRoute . "/rest/orders";

function httpPost($data,$url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, true);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$output = curl_exec ($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);
	return $code;
}

echo json_encode(array("httpCode" => httpPost($data,$ordersURL), "ordersURL" => $ordersURL));

?>
