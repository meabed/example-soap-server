<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/TestSoap.php';

ini_set("soap.wsdl_cache_enabled", 1);

$siteURL = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['HTTP_HOST'] . '/';

$time_start = microtime(true);

$soap = new Zend\Soap\Server($siteURL . 'wsdl.php');
$soap->setClass(TestSoap::class);
$soap->setReturnResponse(true);
$response = $soap->handle();

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);

$uuid4 = \Ramsey\Uuid\Uuid::uuid4();

$result = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding" >
<SOAP-ENV:Header>
<ResponseHeader>
<requestId>' . $uuid4->toString() . '</requestId>
<responseTime>' . $execution_time . '</responseTime>
</ResponseHeader>
</SOAP-ENV:Header>
<SOAP-ENV:Body>
' . $response . '
</SOAP-ENV:Body>
</SOAP-ENV:Envelope>';


// pretty xml
$dom = new \DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->loadXML($result);
$dom->formatOutput = true;

echo $dom->saveXml();

exit;
