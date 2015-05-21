<?php
require 'Baidu.php';
$clientId = 'pxtCHoKbSHIssVgHlHs8VqQy';
$clientSecret = 'L9IhETRSIubyeV8YHzCxTKgjo2c0Ea58';
$redirectUri = 'http://www.pangyiguang.com/callback_baidu';

$baidu = new Baidu($clientId, $clientSecret, $redirectUri, new BaiduCookieStore($clientId));
// Get User ID and User Name
$user = $baidu->getLoggedInUser();
