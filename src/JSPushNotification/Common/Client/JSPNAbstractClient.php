<?php

/**
 * JSPNResponse entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */

namespace JSPushNotification\Common\Client;

use GuzzleHttp\Client as GuzzleClient;
use JSPushNotification\Config\JSPNConfigManager;
use JSPushNotification\Helper\JSPNApiHelper;
use JSPushNotification\Entity\JSPNResponse;

abstract class JSPNAbstractClient {

    const PARAM_APPLICATION_ID  = 'application';

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    
    const VERSION = '1.0.0';
    
    /**
     *
     * @var array
     */
    private $config = array();

    /**
     * 
     * @param array $config
     */
    public function __construct($config = NULL) {
        
        if($config == NULL){
            $configManager = JSPNConfigManager::getInstance();
            $this->config = $configManager->getConfig();
        }
        else {
            $this->config = JSPNConfigManager::mergeConfig($config);
        }
    }
    
    /**
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * 
     * @param string $url
     * @param array $parameter
     * @return \JSPushNotification\Entity\JSPNResponse
     */
    protected function request($url, $parameter) {
        $parameter[self::PARAM_APPLICATION_ID] = $this->config['applicationId'];
        $response = $this->getClient()->post($url, array(
            'body'  => $parameter
        ));
        
        return new JSPNResponse(get_object_vars(json_decode($response->getBody())));
    }
    
    /**
     * 
     * @return \GuzzleHttp\Client
     */
    protected function getClient() {
        if(!$this->client) {
            $apiHelper = JSPNApiHelper::getInstance();
            $this->client = new GuzzleClient(array('base_url' => $apiHelper->getBaseUrl()));
        }
        
        return $this->client;
    }
}