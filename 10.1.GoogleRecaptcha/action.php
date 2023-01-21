<?php

if ($_POST) {

    $postURL = "https://www.google.com/recaptcha/api/siteverify";
    $secret = "6LcRaPwjAAAAAAbWrQBWuvP6F9gDSe3kG4bQ0IAU";
    $response = $_POST['g-recaptcha-response'];

    $curlx = curl_init();
    curl_setopt($curlx, CURLOPT_URL, $postURL);
    curl_setopt($curlx, CURLOPT_HEADER, 0);
    curl_setopt($curlx, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlx, CURLOPT_POST, 1);

    $post_data = [
        "secret" => $secret,
        "response" => $response
    ];

    curl_setopt($curlx, CURLOPT_POSTFIELDS, $post_data);
    $resp = json_decode(curl_exec($curlx));
    curl_close($curlx);

    if ($resp->success == true) {
        //Google recaptcha is successful
        //form submit operation

        var_dump("<pre>", $_POST);exit();
    }else{
        //Google recaptcha verification failed
    }


}
