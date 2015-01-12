<?php

/**
 * JSPNResponse entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */

namespace JSPushNotification\Common\Client;

use Guzzle\Http\Client as GuzzleClient;
use JSPushNotification\Config\JSPNConfigManager;
use JSPushNotification\Helper\JSPNApiHelper;
use JSPushNotification\Entity\JSPNResponse;

abstract class JSPNAbstractClient {

    const PARAM_APPLICATION_ID  = 'application';
    const PARAM_SDK_VERSION     = 'sdk_version';

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    
    const VERSION = '2';
    
    /**
     *
     * @var array
     */
    private $config = array();

    /**
     * 
     * @param array $config
     */
    public function __construct(array $config = NULL) {
        
        $configManager = JSPNConfigManager::getInstance();
        if($config == NULL){
            $this->config = $configManager->getConfig();
        }
        else {
            $this->config = $configManager->mergeConfig($config);
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
    protected function request($url, $parameter, $version = self::VERSION) {
        $parameter[self::PARAM_APPLICATION_ID] = $this->config['applicationId'];
        $parameter[self::PARAM_SDK_VERSION] = $version;
        $request = $this->getClient()->post($url, array(), $parameter);
        $response = $request->send();

        return new JSPNResponse($response->json());
    }
    
    /**
     * 
     * @return \GuzzleHttp\Client
     */
    protected function getClient() {
        if(!$this->client) {
            $apiHelper = JSPNApiHelper::getInstance();
            $this->client = new GuzzleClient($apiHelper->getBaseUrl(), array(
                'request.options' => array(
                    'timeout'         => 10,
                    'connect_timeout' => 5
                )
            ));
        }
        
        return $this->client;
    }
}