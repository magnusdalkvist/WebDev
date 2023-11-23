<?php

$message = $_GET['message'];

$url = 'https://fiotext.com/send-sms';
$data = [
    'user_api_key' => '5364bdb6f4d6254b40fbcca441f9f15f',
    'sms_message' => $message,
    'sms_to_phone' => '22285895'
];

// use key 'http' even if you send the request to https://...
$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === false) {
    /* Handle error */
}

var_dump($result);
