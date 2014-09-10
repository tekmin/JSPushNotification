<?php

/**
 * Client SDK to request Push Notification Service
 *
 * @package JSPushNotification
 */
namespace JSPushNotification;

use JSPushNotification\Common\Client\JSPNAbstractClient;
use JSPushNotification\Exception\InvalidParameterException;
use JSPushNotification\Validator\JSPNPlatform as JSPNPlatformValidator;

class Client extends JSPNAbstractClient {
    
    const PARAM_USER_ID         = 'user_id';
    const PARAM_DEVICE_TOKEN    = 'token';
    const PARAM_PLATFORM_CODE   = 'os';
    const PARAM_MESSAGE         = 'message';
    const PARAM_DATA            = 'data';
    const PARAM_OPTIONS         = 'options';
    
    /**
     * 
     * @param int $userId
     * @param string $deviceToken
     * @param int $platformCode
     * @param string $appVersion
     * @return stdClass
     */
    public function registerDevice($userId, $deviceToken, $platformCode, $appVersion = NULL) {
        if(empty($userId)) {
            throw new InvalidParameterException('Invalid user id has been provided in parameter 1 in ' . __METHOD__ . '()');
        }
        
        if(empty($deviceToken)) {
            throw new InvalidParameterException('Invalid device token has been provided in parameter 2 in ' . __METHOD__ . '()');
        }
        
        $validator = new JSPNPlatformValidator();
        if(!$validator->isValid($platformCode)) {
            throw new InvalidParameterException('Invalid platform code has been provided in parameter 3 in ' . __METHOD__ . '()');
        }
        
        return $this->request('register.php', array(
            self::PARAM_USER_ID         => $userId,
            self::PARAM_DEVICE_TOKEN    => $deviceToken,
            self::PARAM_PLATFORM_CODE   => $platformCode
        ));
    }
    
    /**
     * 
     * @param int $userId
     * @param string $deviceToken
     * @return stdClass
     */
    public function unregisterDevice($userId, $deviceToken) {
        if(empty($userId)) {
            throw new InvalidParameterException('Invalid user id has been provided in parameter 1 in ' . __METHOD__ . '()');
        }
        
        if(empty($deviceToken)) {
            throw new InvalidParameterException('Invalid device token has been provided in parameter 2 in ' . __METHOD__ . '()');
        }
        
        return $this->request('unregister.php', array(
            self::PARAM_USER_ID         => $userId,
            self::PARAM_DEVICE_TOKEN    => $deviceToken
        ));
    }
    
    /**
     * 
     * @param int $userId
     * @param message $message
     * @param array $data
     * @param array $options
     * @return stdClass
     */
    public function publishMessage($userId, $message, array $data = array(), array $options = array()) {
        if(empty($userId)) {
            throw new InvalidParameterException('Invalid user id has been provided in parameter 1 in ' . __METHOD__ . '()');
        }
        
        return $this->request('publish.php', array(
            self::PARAM_USER_ID => $userId,
            self::PARAM_MESSAGE => $message,
            self::PARAM_DATA    => $data,
            self::PARAM_OPTIONS => $options
        ));
    }

}
