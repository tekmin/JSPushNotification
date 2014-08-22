<?php

/**
 * Exception
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Common\Exception;

class JSPNException extends \Exception {
    
    /**
     *
     * @var string
     */
    private $plainMessage = '';

    public function __construct($message = '', $code = 0, $previous = NULL) {
        $this->plainMessage = $message;
        
        $message = 'Unexpected '. get_class($this) . " has been thrown. Message: $message";
        
        parent::__construct($message, $code, $previous);
    }
    
    public function getPlainMessage() {
        return $this->plainMessage;
    }
    
}

