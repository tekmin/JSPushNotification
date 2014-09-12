<?php

/**
 * JSPNAPNSNotification entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Entity;

use JSPushNotification\Entity\JSPNPlatformNotification;

class JSPNAPNSNotification extends JSPNPlatformNotification{

    public function __construct() {
        $this->key = 'APNS';
    }
}
