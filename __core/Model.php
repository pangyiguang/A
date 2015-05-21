<?php
/**
 * Description of Model
 *
 * @author pangyiguang
 */
abstract class Model {
    
    static $_db = array();
    private $_dbIdentify = null;
    private $_dbName = null;
    private $_tableName = null;
    private $__primaryKey = 'id';
    
}
