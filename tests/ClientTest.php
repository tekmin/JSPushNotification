<?php

/**
 * Test for Client.php
 *
 * @package JSPushNotification
 */

use JSPushNotification\Client;
use JSPushNotification\Entity\JSPNResponse;

class ClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider userToRegisterDevice
     */
    public function testRegisterDevice($userId, $deviceToken, $platformCode, $expectedResult) {
        $client = new Client();
        $response = $client->registerDevice($userId, $deviceToken, $platformCode);
        
        $this->assertTrue($response instanceof JSPNResponse);
        $this->assertEquals($response->status, $expectedResult);
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testRegisterDeviceInvalidUserId() {
        $client = new Client();
        $client->registerDevice('', '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1', 3);
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testRegisterDeviceInvalidDeviceToken() {
        $client = new Client();
        $client->registerDevice(9716635, '', 3);
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testRegisterDeviceInvalidPlatformCode() {
        $client = new Client();
        $client->registerDevice(9716635, '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1', 4);
    }
    
    public function userToRegisterDevice() {
        return array(
            array(9716635, '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1', 3, 1),
            array(9716635, '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1', 1, 1),
            array(9716635, '12345', 1, 0),
            array(9716635, '12345', 3, 0),
        );
    }
    
    /**
     * @dataProvider messageToSendToUser
     */
    public function testPublishMessage($expectedResult, $userId, $message, $data = array(), $option = array()) {
        $client = new Client();
        $response = $client->publishMessage($userId, $message, $data, $option);
        
        $this->assertTrue($response instanceof JSPNResponse);
        $this->assertEquals($response->status, $expectedResult);
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testPublishMessageInvalidUserId() {
        $client = new Client();
        $client->publishMessage('', 'Testing publish message function exception');
    }
    
    public function messageToSendToUser() {
        return array(
            array(1, 9716635, 'Testing publish message function', array('foo' => 'bar'), array()),
            array(0, 12345, 'Testing publish message function for not exist user', array('foo' => 'bar'), array()),
            array(0, 9716635, 'Testing publish message function for too long message Testing publish message function for too long message Testing publish message function for too long message Testing publish message function for too long message Testing publish message function for too long message', array('foo' => 'bar'), array()),
        );
    }
    
    /**
     * @dataProvider userToUnregisterDevice
     */
    public function testUnregisterDevice($userId, $deviceToken, $expectedResult) {
        $client = new Client();
        $response = $client->unregisterDevice($userId, $deviceToken);
        
        $this->assertTrue($response instanceof JSPNResponse);
        $this->assertEquals($response->status, $expectedResult);
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testUnregisterDeviceInvalidUserId() {
        $client = new Client();
        $client->unregisterDevice('', '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1');
    }
    
    /**
     * @expectedException \JSPushNotification\Exception\InvalidParameterException
     */
    public function testUnregisterDeviceInvalidDeviceToken() {
        $client = new Client();
        $client->unregisterDevice(9716635, '');
    }
    
    public function userToUnregisterDevice() {
        return array(
            array(9716635, '39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1', 1),
            array(9716635, '12345', 0),
        );
    }
}
