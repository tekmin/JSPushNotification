<?php

/**
 * JSPNResponse entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Entity;

use JSPushNotification\Entity\Response\JSPNResponseError;

class JSPNResponse {

    const STATUS    = 'status';
    const ERROR     = 'error';
    const MESSAGE   = 'message';
    
    /**
     *
     * @var int
     */
    public $status;
    
    /**
     *
     * @var array
     */
    public $data = array();
    
    /**
     *
     * @var \JSPushNotification\Entity\Response\JSPNResponseError 
     */
    public $error;
    
    public function __construct(array $data) {
        $this->status = (int)$data[self::STATUS];
        unset($data[self::STATUS]);
        
        $this->error = new JSPNResponseError($data);
        
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }
}