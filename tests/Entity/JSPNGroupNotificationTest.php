<?php

/**
 * Test for JSPNGroupNotification.php
 *
 * @package JSPushNotification
 */

use JSPushNotification\Entity\JSPNNotification;
use JSPushNotification\Entity\JSPNAPNSNotification;
use JSPushNotification\Entity\JSPNGCMNotification;
use JSPushNotification\Entity\JSPNGroupNotification;

class JSPNGroupNotificationTest extends PHPUnit_Framework_TestCase {

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
        
        $apnsNotification = new JSPNAPNSNotification();
        $apnsNotification->addNotification($notification);
                
        $gcmNotification = new JSPNGCMNotification();
        $gcmNotification->addNotification($notification);
        
        $groupNotification = new JSPNGroupNotification();
        $groupNotification->addPlatformNotification($apnsNotification);
        $groupNotification->addPlatformNotification($gcmNotification);
        $this->assertEquals(array(
            'APNS' => array(
                array(
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
                )
            ),
            'GCM' => array(
                array(
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
                )
            )
        ), $groupNotification->toArray());

    }
}
