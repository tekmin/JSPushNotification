<?php

/**
 * JSPNNotification entity
 *
 * @author Tek Min <tekmin@jobstreet.com>
 * @package JSPushNotification
 */
namespace JSPushNotification\Entity;

class JSPNNotification {
    
    /**
     *
     * @var string
     */
    private $version;
    
    /**
     *
     * @var string
     */
    private $message;
    
    /**
     *
     * @var array
     */
    private $data = array();
    
    /**
     *
     * @var array
     */
    private $options = array();

    /**
     * 
     * @param string $version
     */
    public function __construct($version = '*') {
        $this->version = $version;
    }
    
    /**
     * 
     * @param array $data
     */
    public function appendData(array $data) {
        $this->data = array_merge($this->data, $data);
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function addData($key, $value) {
        $this->data[$key] = $value;
    }
    
    /**
     * 
     * @param array $options
     */
    public function appendOptions(array $options) {
        $this->options = array_merge($this->options, $options);
    }
    
    /**
     * 
     * @param string $key
     * @param string $value
     */
    public function addOptions($key, $value) {
        $this->options[$key] = $value;
    }
    
    /**
     * 
     * @return array
     */
    public function toArray() {
        foreach ($this->data as $key => &$value) {
            $this->data[$key] = rawurlencode($value);
        }
        
        foreach ($this->options as $key => &$value) {
            $this->options[$key] = rawurlencode($value);
        }
        
        return array(
            'version' => rawurlencode($this->version),
            'message' => rawurlencode($this->message),
            'data'    => $this->data,
            'options' => $this->options,
        );
    }
    
    /**
     * 
     * @param string $version
     */
    public function setVersion($version) {
        $this->version = $version;
    }
    
    /**
     * 
     * @param string $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }
    
    /**
     * 
     * @param array $data
     */
    public function setData(array $data) {
        $this->data = $data;
    }
    
    /**
     * 
     * @param array $options
     */
    public function setOptions(array $options) {
        $this->options = $options;
    }
    
    /**
     * 
     * @return string
     */
    public function getVersion() {
        return $this->version;
    }
    
    /**
     * 
     * @return array
     */
    public function getMessage() {
        return $this->message;
    }
    
    /**
     * 
     * @return array
     */
    public function getData() {
        return $this->data;
    }
    
    /**
     * 
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }
}
