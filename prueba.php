<?php

$url = 'http://localhost:3001';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$post_data = '{"id": "Ss5MxnHqHu7kl0oa6zQHNOxZb9o2pHMs", "data": "My Block first"}';
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
$output = curl_exec($ch);
var_dump($output);