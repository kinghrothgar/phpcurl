<?php

function curl_download($Url){
 
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
 
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);
 
    // Set a referer
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    //curl_setopt($ch, CURLOPT_HEADER, true);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // The maximum number of seconds to allow cURL funtion to excecute
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);

    // Connection timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);

    // Stop cURL from verifying the peer's certificate.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Force the use of a new connection instead of a cached one
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

    // Force the connect to close when it has finished processing
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);

    // output verbose information. Writes output to STDERR, or the file specified using CURLOPT_STDERR
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    // Stuff
    $curl_stderr = fopen('curl_verbose.log', 'a');
    fwrite($curl_stderr, strftime('[%c]' . " "));
    curl_setopt($ch, CURLOPT_STDERR, $curl_stderr);

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    $code = (int)$info['http_code'];
    if ($response === false) {
        return array('success' => false, 'code' => $code, 'response' => '',
                     'error' => curl_error($ch), 'info' => $info);
    }
    
    curl_close($ch);
    fwrite($curl_stderr, "\n");

    
    return array('success' => true, 'code' => $code, 'response' => $response, 'info' => $info);
}

$result = curl_download($argv[1]);

if ($result['code'] == 0) {
    print strftime('[%c]') . " Error\n";
    throw new Exception('Unknown Google error. Throwing exception so details dont go unnoticed: ' . print_r($result, true));
} else {
    print strftime('[%c]') . " Success\n";
}


?>

