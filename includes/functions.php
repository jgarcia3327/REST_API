<?php
// Method: POST, PUT, GET etc
// Url: $SITE_URL.'REST/request/list' = all books, $SITE_URL.'REST/request/list/1/' = certain book

function callREST($method, $url) {
    $curl = curl_init();

    switch ($method)
    {
        case "POST": curl_setopt($curl, CURLOPT_POST, 1); break;
        case "PUT": curl_setopt($curl, CURLOPT_PUT, 1); break;
        case "DELETE": curl_setopt($curl, CURLOPT_DELETE, 1); break;
        default: curl_setopt($curl, CURLOPT_HTTPGET, 1);
    }

    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    //Set encoding
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Accept:application/json, text/javascript, */*; q=0.01"));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>
