<?php

/**
 * JSPNResponse entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Entity\Response;

class JSPNResponseError {
    
    const ERROR_CODE = 'error';
    const ERROR_MESSAGE = 'message';

    /**
     *
     * @var int
     */
    public $errorCode;
    
    /**
     *
     * @var string
     */
    public $message;
    
    public function __construct(array $data) {
        $this->errorCode = (!empty($data[self::ERROR_CODE])) ? (int)$data[self::ERROR_CODE] : 0;
        $this->message   = (!empty($data[self::ERROR_MESSAGE])) ? $data[self::ERROR_MESSAGE] : '';        
    }
}