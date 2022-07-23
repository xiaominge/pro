<?php

/**
 * Request
 * @author 徐亚坤 hdyakun@sina.com
 */

namespace Core;
use Core\Support\Secure;

class Request extends Http\Request
{
    /**
     * 获取请求方法
     * @access   public
     */
    public static function getMethod()
    {
        if (null === self::$requestInstance->method) {
            self::$requestInstance->method = strtoupper(self::server('REQUEST_METHOD'));

            if ('POST' === self::$requestInstance->method) {
                if ($method = self::server('X-HTTP-METHOD-OVERRIDE')) {
                    self::$requestInstance->method = strtoupper($method);
                } elseif (self::$requestInstance->httpMethodParameterOverride) {
                    self::$requestInstance->method = strtoupper(Input::post('_method', Input::get('_method', 'POST')));
                }
            }
        }

        return self::$requestInstance->method;
    }

   /**
    * 获取 $_SERVER 值
    *
    * @access   public
    * @param    string 键值
    * @param    string 默认值
    * @param    bool 是否清除xss字符
    * @return   mix
    */
    public static function server($index = null, $default = '', $xssClean = FALSE)
    {
        if ($index === null) {
            $default = array();
        }
        return self::fetch($_SERVER, $index, $default, $xssClean);
    }

    /**
     * 获取GET或POST请求数据
     *
     * @access   public
     * @param    string  键值
     * @param    string  未获取数据时的默认值
     * @param    bool    是否清除xss字符
     * @return   mix
     */
    public static function input($index = null, $default = '', $xssClean = FALSE)
    {
        if ($index === null) {
            $default = array();
        }
        if (!isset($_POST[$index])) {
            return Input::get($index, $default, $xssClean);
        } else {
            return Input::post($index, $default, $xssClean);
        }
    }

    /**
     * 获取数组中的单个值或所有值
     * @param $data
     * @param $index
     * @param $default
     * @param $xssClean
     * @return array|string
     */
    public static function fetch($data, $index, $default, $xssClean)
    {
        if ($index === NULL AND !empty($data)) {
            $requestData = array();

            foreach (array_keys($data) as $key) {
                $requestData[$key] = self::fetchFromArray($data, $key, $default, $xssClean);
            }
            return $requestData;
        }

        return self::fetchFromArray($data, $index, $default, $xssClean);
    }

    /**
     * 从数组中获取某个键的值
     * fetch() 方法调用
     * @access  private
     * @param   array
     * @param   string
     * @param   string
     * @param   bool
     * @return  string
     */
    private static function fetchFromArray(&$array, $index = '', $default = '', $xss_clean = FALSE)
    {
        if (!isset($array[$index])) {
            return $default;
        }

        if ($xss_clean === TRUE) {
            return Secure::xssClean($array[$index]);
        }

        return $array[$index];
    }

}