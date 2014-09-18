<?php

/**
 * Test for Client.php
 *
 * @package JSPushNotification
 */
define('JSPN_CONFIG_PATH', __DIR__ . '/config.php');

use JSPushNotification\Client;
use JSPushNotification\Entity\JSPNResponse;
use JSPushNotification\Entity\JSPNNotification;
use JSPushNotification\Entity\JSPNAPNSNotification;
use JSPushNotification\Entity\JSPNGCMNotification;
use JSPushNotification\Entity\JSPNGroupNotification;

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
    
    public function testPublishGroupMessage() {
        $client = new Client();
        $notification = new JSPNNotification('>=3.0.0');
        $notification->setMessage('This is the message');
        $notification->addData('addData', 'Data');
        $notification->addDataArray(array(
           'addDataArray' => 'Array' 
        ));
        $notification->addOptions('addOptions', 'Options');
        $notification->addOptionsArray(array(
            'addOptionsArray' => 'Array'
        ));
        
        $notification2 = new JSPNNotification('>=3.0.0');
        $notification2->setMessage('This is the message2');
        $notification2->addData('addData', 'Data');
        $notification2->addDataArray(array(
           'addDataArray' => 'Array' 
        ));
        $notification2->addOptions('addOptions', 'Options');
        $notification2->addOptionsArray(array(
            'addOptionsArray' => 'Array'
        ));
        
        $apnsNotification = new JSPNAPNSNotification();
        $apnsNotification->addNotification($notification);
        
        $gcmNotification = new JSPNGCMNotification();
        $gcmNotification->addNotification($notification2);
        
        $groupNotification = new JSPNGroupNotification();
        $groupNotification->addPlatformNotification($apnsNotification);
        $groupNotification->addPlatformNotification($gcmNotification);
        
        $response = $client->publishGroupMessage(9716635, $groupNotification);
        $this->assertTrue($response instanceof JSPNResponse);
        $this->assertEquals($response->status, 1);
    }
}
