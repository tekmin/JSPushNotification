<?php

/**
 * JSPNGroupNotification entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */

namespace JSPushNotification\Entity;

use JSPushNotification\Entity\JSPNPlatformNotification;

class JSPNGroupNotification {

    /**
     *
     * @var array
     */
    private $groupNotifications = array();
    
    /**
     * 
     * @param JSPNPlatformNotification $notification
     */
    public function addPlatformNotification(JSPNPlatformNotification $notification) {
        $this->groupNotifications[] = $notification;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $array = array();
        foreach ($this->groupNotifications as $platformNotification) {
            $array = array_merge($array, $platformNotification->toArray());
        }
        
        return $array;
    }
} 
