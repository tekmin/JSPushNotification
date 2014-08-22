<?php

/**
 * JSPNConfigManager loads config file and handout proper config to other class
 *
 * @package JSPushNotification
 */

namespace JSPushNotification\Config;

class JSPNConfigManager {

    /**
     *
     * @var \JSPushNotification\Config\JSPNConfigManager
     */
    private static $instance;
    
    /**
     *
     * @var array
     */
    private $config;
    
    private function __construct(){
        if(defined('JSPN_CONFIG_PATH')) {
            $configFile = constant('JSPN_CONFIG_PATH');
        } else {		
            $configFile = implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "..", "jspn_config.php"));
        }
        
        $this->loadConfigFromFile($configFile);
    }
    
    /**
     * Get singleton config manager
     * 
     * @return \JSPushNotification\Config\JSPNConfigManager
     */
    public static function getInstance()
    {
        if (!isset(self::$instance) ) {
            self::$instance = new JSPNConfigManager();
        }
        
        return self::$instance;
    }
    
    /**
     * Merge user config with default config
     * 
     * @param array $config
     */
    public function mergeConfig(array $config) {
        $this->config = array_merge($this->config, $config);
    }
    
    /**
     * Load config from config file
     * 
     * @param string $configFile
     * @throws \Exception
     */
    private function loadConfigFromFile($configFile) {
        if(file_exists($configFile)) {
            $this->config = include $configFile;
        }
        else {
            throw new \Exception("Config file at path $configFile is not exist");
        }
    }
    
    /**
     * Get config load from default config file
     * 
     * @return array
     */
    public function getConfig() {
        return $this->config;
    }
}
