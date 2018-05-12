<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/TestSoap.php';

ini_set("soap.wsdl_cache_enabled", 0);
ini_set("soap.wsdl_cache_ttl", 600);

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';

$time_start = microtime(true);

$soap = new Zend\Soap\Server($siteURL . 'wsdl.php');
$soap->setClass(TestSoap::class);
$soap->setReturnResponse(true);

$response = $soap->handle();


if (!headers_sent()) {
    header('Content-Type: application/xml');
}

echo $response;
exit;
