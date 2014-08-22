<?php

/**
 * Platform validator - validate the platform code is available
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */

namespace JSPushNotification\Validator;

use Reference\JSPNPlatform as JSPNPlatformReference;

class JSPNPlatform {

    public function isValid($platformCode) {
        $platforms = array(
            JSPNPlatformReference::iOS,
            JSPNPlatformReference::ANDROID,
            JSPNPlatformReference::iOS_SANDBOX
        );
        
        return in_array($platformCode, $platforms);
    }
}
