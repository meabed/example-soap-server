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
     * return full name as it is in input
     * @param string $session session from login method
     * @param string $firstName user firstname
     * @param string $lastName user lastname
     * @return array
     * @throws SoapFault
     */
    public function getFullname($session, $firstName, $lastName)
    {
        $this->validateSession($session);
        if (!$firstName || !$lastName) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }

        $rsArr = ['Fullname' => join(' ', [$firstName, $lastName])];

        return $rsArr;
    }


    /**
     * Generate webservice session from login info
     * @param array $param login param [username,password]
     * @return array
     * @throws SoapFault
     */
    public function login($param = [])
    {
        if (count($param) != 2) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }
        $rsArr = ['SessionId' => join('', $param) . '-loggedin'];

        return $rsArr;
    }

    /**
     * Say Hello!
     * @param string $session session from login method
     * @param string $name name
     * @return array
     * @throws SoapFault
     */
    public function sayHello($session, $name)
    {
        $this->validateSession($session);
        if (!$name) {
            throw new \SoapFault('1001EC', 'Invalid params');
        }
        $rsArr = ['Text' => 'Hello ' . $name];

        return $rsArr;
    }

}