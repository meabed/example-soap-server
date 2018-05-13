<?php
require __DIR__ . '/../vendor/autoload.php';

ini_set("soap.wsdl_cache_enabled", 1);
ini_set("soap.wsdl_cache_ttl", 600);

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';


$soap = new Zend\Soap\Server($siteURL . 'wsdl.php');
$soap->setClass(\Lib\TestSoap::class);
$soap->handle();