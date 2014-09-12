<?php

/**
 * JSPNGroupedMessage entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */

namespace JSPushNotification\Entity;

use JSPushNotification\Entity\JSPNPlatformNotification;

class JSPNGroupedMessage {

    /**
     *
     * @var array
     */
    private $groupedNotifications = array();
    
    /**
     * 
     * @param JSPNPlatformNotification $notification
     */
    public function addPlatformNotification(JSPNPlatformNotification $notification) {
        $this->groupedNotifications[] = $notification;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $array = array();
        foreach ($this->groupedNotifications as $platformNotification) {
           $array[$platformNotification->getKey()] = $platformNotification->toArray();
        }
        
        return $array;
    }
} 
