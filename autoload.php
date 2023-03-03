<?php

$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}/akshayRautTest/";
$guestCss = $base_url."css/guestCss.css";
$guestJS = $base_url."js/guestJS.JS";
$css = $base_url."node_modules/bootstrap/dist/css/bootstrap.min.css";
$js = $base_url."node_modules/jquery/dist/jquery.min.js";
$apiBaseUrl = $base_url."crmAPI/";
?>