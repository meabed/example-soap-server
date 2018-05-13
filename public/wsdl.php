<?php
require __DIR__ . '/../vendor/autoload.php';

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';
$uri = $siteURL . 'server.php';
$autodiscover = new \Zend\Soap\AutoDiscover();
$autodiscover->setUri($uri);
$autodiscover->setServiceName('TestSoap');
$autodiscover->setClass(\Lib\TestSoap::class);
$autodiscover->handle();