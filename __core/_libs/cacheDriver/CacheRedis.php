<?php
defined('AHA_ROOT') OR die('Unauthorized access!');
/**
 * redis缓存
 * @author pangyiguang
 */
class CacheRedis implements CacheDriver {
    
    private $_key=null;
    private $_Redis=null;
    
    function __construct($initArr = array()) {
        try {
            $init=AHA::getConfig('redis');
            $this->_Redis=new Redis();
            $this->_Redis->pconnect($init['default']['host'], $init['default']['port'], $init['default']['timeout']);
            if($init['default']['password']){
			    $this->_Redis->auth($init['default']['password']);	// 密码
			}
			$this->_Redis->select($init['default']['selectdb']);
        } catch (Exception $exc) {
            Common::output($exc->getMessage());
        }
    }
    
    function get($prefix,$key, $optionArr = array()) {
        $this->_getKey($prefix, $key);
        return $this->_Redis->get($this->_key);
    }
    
    function set($prefix,$key, $value, $cacheTime, $optionArr = array()) {
        $this->_getKey($prefix, $key);
        return $this->_Redis->setex($this->_key, $cacheTime, $value);
    }
    
    function stats($prefix,$key, $optionArr = array()) {
        return $this->_Redis->info();
    }
    
    function del($prefix,$key, $optionArr = array()) {
        $this->_getKey($prefix, $key);
        return $this->_Redis->delete($this->_key);
    }
    
    function increment($prefix,$key,$num=1){
        $this->_getKey($prefix, $key);
        return $this->_Redis->incr($this->_key,(int)$num);
    }
    
    function decrement($prefix,$key,$num=1){
        $this->_getKey($prefix, $key);
        return $this->_Redis->decr($this->_key,(int)$num);
    }
    
    function clean($prefix,$optionArr = array()) {
        return $this->_Redis->flushdb();
    }
    
    private function _getKey($prefix,$key){
        if($prefix){
            $prefix = str_replace(array('-','_',',','/','|','\\'), ':', $prefix);
        }
        $this->_key=$prefix.':'.md5($key);
    }
}
