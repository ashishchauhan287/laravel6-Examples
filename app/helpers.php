<?php

function convertCurrency($amount,$from_currency,$to_currency){
    $apiKey = '116c357a360c66cbd8e2';

    $from_Currency = urlencode($from_currency);
    $to_Currency = urlencode($to_currency);
    $query =  "{$from_Currency}_{$to_Currency}";

    // change to the free URL if you're using the free version
    $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apiKey}");
    $obj = json_decode($json, true);

    $val = floatval($obj["$query"]);

    $total = $val * $amount;
    return number_format($total, 2, '.', '');
}