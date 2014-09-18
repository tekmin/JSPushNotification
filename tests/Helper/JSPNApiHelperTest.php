<?php

/**
 * Test for JSPNApiHelper.php
 *
 * @package JSPushNotification
 */
use JSPushNotification\Config\JSPNConfigManager;
use JSPushNotification\Helper\JSPNApiHelper;

class JSPNApiHelperTest extends PHPUnit_Framework_TestCase {
    
//    protected function setUp() {
//        JSPNConfigManager::reset();
//        JSPNApiHelper::reset();
//        define('JSPN_CONFIG_PATH', dirname(__file__) . DIRECTORY_SEPARATOR .'../config.php');
//    }

    public function testGetBaseUrl() {
        $helper = JSPNApiHelper::getInstance();
        $this->assertEquals('http://m-uat.jobstreet.com/api/Notification/', $helper->getBaseUrl());
    }
//    
//    protected function tearDown() {
//        JSPNConfigManager::reset();
//        JSPNApiHelper::reset();
//    }
}
