<?php
use PHPUnit\Framework\TestCase;

function RetrieveItems()
{
    $podHost = getenv("HOSTNAME");
    //echo "\r\podHost:" . $podHost;
    $pos = strpos($podHost, '-ui-');
    $catalogHost = substr($podHost, 0, $pos) . "-catalog-api"; 
    $catalogRoute = "http://" . $catalogHost;
    //echo "\r\ncatalogRoute:" . $catalogRoute;    
    $url = $catalogRoute . "/items";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $curlResult = curl_exec($curl);
    $curlError = curl_error($curl);
    $curlErrno = curl_errno($curl);
    curl_close($curl);
    $firstChar = substr($curlResult, 0, 1); /* should check if $curlResult === FALSE if newer PHP */
    if ($firstChar != "{") {
        $errorObject = new stdClass();
        $errorObject->error = $curlError;
        $errorObject->errno = $curlErrno;
        return json_encode($errorObject);
    }
    return $curlResult;
}

?>

