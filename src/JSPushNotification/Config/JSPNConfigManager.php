<?php

/**
 * JSPNConfigManager loads config file and handout proper config to other class
 *
 * @package JSPushNotification
 */

namespace JSPushNotification\Config;

use JSPushNotification\Exception\MissingConfigException;

class JSPNConfigManager {

    /**
     *
     * @var \JSPushNotification\Config\JSPNConfigManager
     */
    private static $instance;
    
    private $requiredConfig = array(
        'applicationId'
    );
    
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
    
    public static function reset() {
        self::$instance = NULL;
    }
    
    /**
     * Merge user config with default config
     * 
     * @param array $config
     */
    public function mergeConfig(array $config) {
        $this->config = array_merge($this->config, $config);
        
        $this->checkRequiredConfig();
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
     * 
     * @throws MissingConfigException
     */
    private function checkRequiredConfig() {
        foreach ($this->requiredConfig as $key) {
            if(empty($this->config[$key])) {
                throw new MissingConfigException("Config with key '$key' is missing in the config provided.");
            }
        }
        
    }
    
    /**
     * Get config load from default config file
     * 
     * @return array
     */
    public function getConfig() {
        $this->checkRequiredConfig();
        
        return $this->config;
    }
}
