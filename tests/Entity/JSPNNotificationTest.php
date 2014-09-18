<?php

/**
 * Test for JSPNNotification.php
 *
 * @package JSPushNotification
 */

use JSPushNotification\Entity\JSPNNotification;

class JSPNNotificationTest extends PHPUnit_Framework_TestCase {
    
    private $version = '1.1.1';
    private $message = 'This is sample message';
    private $data1 = array('data1' => 'value1');
    private $data2 = array('data2' => 'value2');
    private $options1 = array('options1' => 'value1');
    private $options2 = array('options2' => 'value2');

    public function testConstructor() {
        $notification = new JSPNNotification($this->version);
        $this->assertEquals($notification->getVersion(), $this->version);;
    }

    public function testAddDataArray() {
        $notification = new JSPNNotification($this->version);
        $notification->setData($this->data1);
        $notification->addDataArray($this->data2);
        $this->assertEquals(array_merge($this->data1, $this->data2), $notification->getData());
    }

    public function testAddData() {
        $notification = new JSPNNotification($this->version);
        $notification->addData('data3', 'value3');
        $this->assertEquals(array('data3' => 'value3'), $notification->getData());
    }

    public function testAddOptionsArray() {
        $notification = new JSPNNotification($this->version);
        $notification->setOptions($this->options1);
        $notification->addOptionsArray($this->options2);
        $this->assertEquals(array_merge($this->options1, $this->options2), $notification->getOptions());
    }

    public function testAddOptions() {
        $notification = new JSPNNotification($this->version);
        $notification->addOptions('options3', 'value3');
        $this->assertEquals(array('options3' => 'value3'), $notification->getOptions());
    }
    
    public function testToArray() {
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
        $this->assertEquals(array(
            'version' => '%3E%3D3.0.0',
            'message' => 'This%20is%20the%20message',
            'data'    => array(
                'addData' => 'Data',
                'addDataArray' => 'Array'
            ),
            'options' => array(
                'addOptions' => 'Options',
                'addOptionsArray' => 'Array'
            )
        ), $notification->toArray());
    }
    
    public function testSetVersion() {
        $notification = new JSPNNotification('1.1.1');
        $notification->setVersion($this->version);
        $this->assertEquals($this->version, $notification->getVersion());

    }

    public function testSetMessage() {
        $notification = new JSPNNotification($this->version);
        $notification->setMessage($this->message);
        $this->assertEquals($this->message, $notification->getMessage());
    }

    public function testSetData() {
        $notification = new JSPNNotification($this->version);
        $notification->setData($this->data1);
        $this->assertEquals($this->data1, $notification->getData());
    }

    public function testSetOptions() {
        $notification = new JSPNNotification($this->version);
        $notification->setOptions($this->options1);
        $this->assertEquals($this->options1, $notification->getOptions());
    }
}
