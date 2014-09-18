<?php

/**
 * JSPNPlatformNotification entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Entity;

use JSPushNotification\Entity\JSPNNotification;

abstract class JSPNPlatformNotification {
    
    /**
     *
     * @var string
     */
    protected $key;
    
    /**
     *
     * @var array
     */
    protected $notifications = array();

    /**
     * 
     * @param JSPNNotification $notification
     */
    public function addNotification(JSPNNotification $notification) {
        $this->notifications[] = $notification;
    }
    
    /**
     * 
     * @return string
     */
    public function getKey() {
        return $this->key;
    }
    
    /**
     * 
     * @return array
     */
    public function toArray() {
        $array = array();
        foreach ($this->notifications as $notification) {
            $array[$this->key][] = $notification->toArray();
        }
        
        return $array;
    }
}
