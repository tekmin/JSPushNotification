<?php

/**
 * Test for JSPushNotification\Validator\JSPNPlatform
 *
 * @package JSPushNotification
 */

use JSPushNotification\Validator\JSPNPlatform;

class JSPNPlatformTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider platform
     */
    public function testIsValid($expectedResult, $platformCode) {
        $validator = new JSPNPlatform;
        $this->assertEquals($expectedResult, $validator->isValid($platformCode));
    }
    
    public function platform() {
        return array(
            array(FALSE, 0),
            array(TRUE, 1),
            array(TRUE, 2),
            array(TRUE, 3),
            array(FALSE, 4),
        );
    }
}
