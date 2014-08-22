<?php

/**
 * JSPNApiHelper help to construct the api base on the environment base url
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Helper;

use JSPushNotification\Config\JSPNConfigManager;

class JSPNApiHelper {
    
    /**
     *
     * @var base domain for different environment
     */
    public static $DOMAIN_MAP = array(
        'live'  => '',
        'sandbox'   => ''
    );
    
    /**
     *
     * @var string
     */
    private $baseUrl;
    
    /**
     *
     * @var \JSPushNotification\Helper\JSPNApiHelper 
     */
    private static $instance;


    public function __construct() {
        $this->setBaseUrl();
    }
    
    /**
     * Get singleton api helper
     * 
     * @return \JSPushNotification\Helper\JSPNApiHelper
     */
    public static function getInstance()
    {
        if (!isset(self::$instance) ) {
            self::$instance = new JSPNApiHelper();
        }
        
        return self::$instance;
    }

    /**
     * 
     * @return string
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }
    
    /**
     * 
     * @param string $url
     * @return string
     */
    public function getUrl($url) {
        return $this->baseUrl . $url;
    }
    
    /**
     * Set base url base on the config settings
     */
    private function setBaseUrl() {
        $configManager = JSPNConfigManager::getInstance();
        $config = $configManager->getConfig();
        
        if($config['isSandbox'] == FALSE) {
            $this->baseUrl = self::$DOMAIN_MAP['live'];
        }
        else {
            $this->baseUrl = self::$DOMAIN_MAP['sandbox'];
        }
    }
}
