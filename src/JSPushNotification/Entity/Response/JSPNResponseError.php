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
        $this->errorCode = (int)$data[self::ERROR_CODE];
        $this->message   = $data[self::ERROR_MESSAGE];
    }
}