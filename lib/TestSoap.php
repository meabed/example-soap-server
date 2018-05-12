<?php

/**
 * lib/TestSoap.php
 */
class TestSoap
{
    /**
     * @param $session
     * @throws SoapFault
     */
    private function validateSession($session)
    {
        if (!strstr($session, '-loggedin')) {
            throw new \SoapFault('1000EC', 'Invalid session');
        }
    }

    /**
     * Return full name as it is in input
     * @param string $session session from login method
     * @param string $firstName user firstname
     * @param string $lastName user lastname
     * @return GetFullNameResponse|SoapFault
     * @throws SoapFault
     */
    public function GetFullName($session, $firstName, $lastName)
    {
        $this->validateSession($session);
        if (!$firstName || !$lastName) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }

        $rs = new GetFullNameResponse();
        $rs->FullName = join(' ', [$firstName, $lastName]);
        return $rs;
    }


    /**
     * Generate webservice session from login info
     * @param array $param login param [username,password]
     * @return LoginResponse|SoapFault
     * @throws SoapFault
     */
    public function Login($param = [])
    {
        if (count($param) != 2 || !$param[0] || !$param[1]) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }
        $rs = new LoginResponse();
        $rs->SessionId = join('', $param) . '-loggedin';
        return $rs;
    }

    /**
     * Say Hello!
     * @param string $session session from login method
     * @param string $name name
     * @return SayHelloResponse|SoapFault
     * @throws SoapFault
     */
    public function SayHello($session, $name)
    {
        $this->validateSession($session);
        if (!$name) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }
        $rs = new SayHelloResponse();
        $rs->Text = 'Hello ' . $name;
        return $rs;
    }

    /**
     * Echo text!
     * @param string $session session from login method
     * @param string $text $text
     * @return string
     * @throws SoapFault
     */
    public function echoText($session, $text)
    {
        $this->validateSession($session);
        if (!$text) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }
        return $text;
    }

}

class FaultResponse
{
    /**
     * Fault Code
     *
     * @var string
     * @access public
     */
    public $Code;

    /**
     * Fault Message
     *
     * @var string
     * @access public
     */
    public $Message;
}

class LoginResponse
{
    /**
     * SessionId
     *
     * @var string
     * @access public
     */
    public $SessionId;
}

class SayHelloResponse
{
    /**
     * Text
     *
     * @var string
     * @access public
     */
    public $Text;
}

class GetFullNameResponse
{
    /**
     * FullName
     *
     * @var string
     * @access public
     */
    public $FullName;
}
