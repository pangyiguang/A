<?php
/**
 * 网站入口必须经过的操作类，处理初始化配置以及参数和文件
 *
 * @author pangyiguang
 */
class AHA {

    const ACT_PREFIX = 'AHA_';//控制器前缀
    
    static $config = null;//配置静态数组
    static $moduleDir = '';//模块的路径标识
    static $uriSegment = array();
    static $actFile = '';

    /**
     * 初始化配置
     * @param type $config 应用定义的配置
     */
    public static function initConfig($config) {
        //在应用的配置基础上合并系统的配置，防止由于参数没有定义导致的出错问题
        self::$config = array_merge(include AHA_ROOT . '/__core/_config/inc.php', $config);
        error_reporting(self::$config['errorReportLevel']);
        date_default_timezone_set(self::$config['defaultTimezone']);
        self::_setSession();
        self::_initMAV();
        self::_setDefine();
        self::_loadFile();
    }

    /**
     * 获取网站应用基本配置信息
     * @param string $key   配置属性key
     * @return mixed
     */
    public static function getConfig($key = '') {
        return ($key && isset(self::$config[$key])) ? self::$config[$key] : self::$config;
    }

    /**
     * 执行控制器方法入口
     * @throws Exception
     */
    public static function goAction() {
        try {
            self::$actFile = ACTION_ROOT . DIRECTORY_SEPARATOR . self::$moduleDir . APP_ACTION . '.php';
            if (file_exists(self::$actFile)) {

                require CORE_ROOT . DIRECTORY_SEPARATOR . 'Controller.php'; //载入控制器父类
                if(self::$config['autoloadController']){
                    require self::$config['autoloadController'];
                }
                require self::$actFile;//载入对应的控制文件

                $app_class = self::ACT_PREFIX . APP_ACTION;
                if (!class_exists($app_class)) {
                    throw new Exception('Not found the action[' . $app_class . '] class!');
                }
                $app = new $app_class();
                $app_method = APP_VIEW;

                if ($app_method === $app_class) {//如果控制器名称与方法相同，默认执行了该方法，停止执行下面
                    throw new Exception('Not found the action[' . $app_class . '] view!');
                }
                if (!method_exists($app, $app_method)) {
                    throw new Exception('Not found the action[' . $app_method . '] view!');
                }
                call_user_func_array(array($app, $app_method),self::$uriSegment);
            } else {
                throw new Exception('Not found the action[' . self::$actFile . '] file!');
            }
        } catch (Exception $exc) {
            Common::output($exc->getMessage());
        }
    }

    private static function _setSession() {
        if (isset(self::$config['sessionConfig']['lifeTime']) && self::$config['sessionConfig']['lifeTime'] > 0) {
            session_set_cookie_params(self::$config['sessionConfig']['lifeTime']);
        }
        if(isset(self::$config['sessionConfig']['start']) && self::$config['sessionConfig']['start']){
            ob_start();
            session_start();
        }
    }

    /**
     * 载入应用初始化要用的文件库
     */
    private static function _loadFile() {
        if (self::$config['autoloadfile'] && self::$config['autoloadfile'] && is_array(self::$config['autoloadfile'])) {
            self::$config['autoloadfile'] = array_unique(self::$config['autoloadfile']);
            foreach (self::$config['autoloadfile'] as $value) {
                if (file_exists($value)) {
                    require $value;
                }
            }
        }
    }

    /**
     * 定义应用定义的常量
     */
    private static function _setDefine() {
        if (self::$config['define'] && is_array(self::$config['define'])) {
            self::$config['define'] = array_unique(self::$config['define']);
            foreach (self::$config['define'] as $key => $value) {
                defined(strtoupper($key)) || define(strtoupper($key), $value);
            }
        }
    }
    
    /**
     * 初始化模块、控制器、方法变量
     */
    private static function _initMAV() {
        if(filter_has_var(INPUT_SERVER, 'PATH_INFO')){
            $pathinfo = filter_input(INPUT_SERVER, 'PATH_INFO');
        }else{
            $pathinfo = rtrim(preg_replace('@^/[^/]+\.php(.*)$@Ui', '\\1', filter_input(INPUT_SERVER, 'PHP_SELF')),'/');
        }
        if($pathinfo){
            $pathinfo = explode('/', trim($pathinfo, '/'));
            if(self::$config['default']['module_open']){
                define('APP_MODULE', array_shift($pathinfo));
            }else{
                define('APP_MODULE', self::$config['default']['module']);
            }
            define('APP_ACTION', isset($pathinfo[0])?array_shift($pathinfo):self::$config['default']['action']);
            define('APP_VIEW', isset($pathinfo[0])?array_shift($pathinfo):self::$config['default']['view']);
            $pathinfo && self::$uriSegment = $pathinfo;
        }else{
            define('APP_MODULE', self::$config['default']['module']);
            define('APP_ACTION', self::$config['default']['action']);
            define('APP_VIEW', self::$config['default']['view']);
        }
        self::$moduleDir = APP_MODULE?APP_MODULE.DIRECTORY_SEPARATOR:'';
    }

}
