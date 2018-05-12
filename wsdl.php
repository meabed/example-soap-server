<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/TestSoap.php';

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';
$uri = $siteURL . 'server.php';

$stub = new TestSoap();

$autodiscover = new \Zend\Soap\AutoDiscover();
$autodiscover->setUri($uri);
$autodiscover->setServiceName('TestSoap');
$autodiscover->setClass(TestSoap::class);
$autodiscover->handle();