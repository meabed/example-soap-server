<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../lib/TestSoap.php';

$time_start = microtime(true);
$time_end = microtime(true);
$eTime = ($time_end - $time_start);

$uuid4 = \Ramsey\Uuid\Uuid::uuid4();


$rsArr = ['SessionId' => join('', ['test']) . '-loggedin'];

$response = \Spatie\ArrayToXml\ArrayToXml::convert($rsArr, 'login');

$response = str_ireplace(['<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>'], '', $response);

function makeResult($uuid4, $eTime, $response)
{

    $result = '<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding" >
<SOAP-ENV:Header>
<ResponseHeader>
<requestId>' . $uuid4 . '</requestId>
<responseTime>' . $eTime . '</responseTime>
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

    return $dom->saveXml();

}


header('Content-Type: application/xml');
echo makeResult($uuid4->toString(), $eTime, $response);
exit;
