<?php

/**
 * Test for JSPNResponse.php
 *
 * @package JSPushNotification
 */

use JSPushNotification\Entity\JSPNResponse;
use JSPushNotification\Entity\Response\JSPNResponseError;

class JSPNResponseTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider jsonResponse
     */
    public function testConstructor($expectedResult, $jsonResponse) {
        $response = new JSPNResponse(get_object_vars(json_decode($jsonResponse)));

        $this->assertEquals($expectedResult['status'], $response->status);
        $this->assertEquals($expectedResult['data'], $response->data);
        $this->assertEquals($expectedResult['error']['code'], $response->error->errorCode);
        $this->assertEquals($expectedResult['error']['message'], $response->error->message);
    }
    
    public function jsonResponse() {
        return array(
            array(
                array(
                    'status' => 1,
                    'data'   => array(
                        'device_signature'  => 'arn:aws:sns:ap-southeast-1:371925667846:endpoint/APNS_SANDBOX/Jobstreet-MobileApp-Dev-APNS/2966bd1a-74b2-3ee1-8ce8-1a93e5327e8b',
                    ),
                    'error'  => array(
                        'code'  => 0,
                        'message'   => ''
                    )
                ), 
                '{"status" : 1,"device_signature": "arn:aws:sns:ap-southeast-1:371925667846:endpoint\/APNS_SANDBOX\/Jobstreet-MobileApp-Dev-APNS\/2966bd1a-74b2-3ee1-8ce8-1a93e5327e8b"}'
            ),
            array(
                array(
                    'status' => 1,
                    'data'   => array(),
                    'error'  => array(
                        'code'  => 0,
                        'message'   => ''
                    )
                ), 
                '{"status" : 1}'
            ),
            array(
                array(
                    'status' => 0,
                    'data'   => array(),
                    'error'  => array(
                        'code'      => 9,
                        'message'   => 'Cannot unregister device for candidate (1), application (1400726882), token (39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1). Return value is 0'
                    )
                ), 
                '{"status" : 0,"message": "Cannot unregister device for candidate (1), application (1400726882), token (39b7dc856002786c0de3a5577b3bb0a6936e120b52ad2b8cf827ac2612faaba1). Return value is 0","error": "9"}'
            ),
        );
    }
}
