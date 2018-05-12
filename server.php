<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/TestSoap.php';

ini_set("soap.wsdl_cache_enabled", 1);

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';

$soap = new Zend\Soap\Server($siteURL . 'wsdl.php');
$soap->setClass(TestSoap::class);
$soap->handle();
