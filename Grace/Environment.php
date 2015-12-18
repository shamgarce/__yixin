<?php

namespace Grace;

class Environment implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var array
     */
    protected $properties;
    protected static $environment;

    public function all()
    {
        return $this->properties;
    }

    public function get($name = '')
    {
        if ($name) {
            return $this->properties[$name];
        } else {
            //返回数据
            return $this->properties;
        }
    }

    /**
     * Get environment instance (singleton)
     */
    public static function getInstance($refresh = false)
    {
        if (is_null(self::$environment) || $refresh) {
            self::$environment = new self();
        }
        return self::$environment;
    }

    /**
     * Get mock environment instance
     *
     * @param  array $userSettings
     *
     * @return \Slim\Environment
     */
    public static function mock($userSettings = array())
    {
        $defaults = array(
            'REQUEST_METHOD' => 'GET',
            'SCRIPT_NAME' => '',
            'PATH_INFO' => '',
            'QUERY_STRING' => '',
            'SERVER_NAME' => 'localhost',
            'SERVER_PORT' => 80,
            'ACCEPT' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'ACCEPT_LANGUAGE' => 'en-US,en;q=0.8',
            'ACCEPT_CHARSET' => 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
            'USER_AGENT' => 'Slim Framework',
            'REMOTE_ADDR' => '127.0.0.1',
            'slim.url_scheme' => 'http',
            'slim.input' => '',
            'slim.errors' => @fopen('php://stderr', 'w')
        );
        self::$environment = new self(array_merge($defaults, $userSettings));
        return self::$environment;
    }

    /**
     * Constructor (private access)
     *
     * @param  array|null $settings If present, these are used instead of global server variables
     */
    private function __construct($settings = null)
    {
        $env = array();

        $env['path'] = $this::pathinfo_query_extend('path');
        $env['query'] = $this::pathinfo_query_extend('query');


        //The HTTP request method
        $env['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        //The IP
        $env['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
        // Server params
        $scriptName = $_SERVER['SCRIPT_NAME']; // <-- "/foo/index.php"
        $requestUri = $_SERVER['REQUEST_URI']; // <-- "/foo/bar?test=abc" or "/foo/index.php/bar?test=abc"
        $queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : ''; // <-- "test=abc" or ""
        // Physical path
        if (strpos($requestUri, $scriptName) !== false) {
            $physicalPath = $scriptName; // <-- Without rewriting
        } else {
            $physicalPath = str_replace('\\', '', dirname($scriptName)); // <-- With rewriting
        }
        $env['SCRIPT_NAME'] = rtrim($physicalPath, '/'); // <-- Remove trailing slashes

        $env['HTTP_HOST'] = $_SERVER['HTTP_HOST'];

        //Input stream (readable one time only; not available for multipart/form-data requests) post data
        $rawInput = @file_get_contents('php://input');
        $env['input.POST'] = $rawInput ?: '';

       //$env['pathinfo_query'] = $this->pathinfo_query();      //弃用

        $this->properties = $env;
    }

    /*
     * @return string
     * 获取地址栏uri信息 http://ap.so/index.php/?sadf&re=adsf
     * -> /index.php/?sadf&re=adsf
     * 分为信息段和query段
     */
    public static function request_uri()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            if (isset($_SERVER['argv'])) {
                $uri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['argv'][0];
            } else {
                $uri = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
            }
        }
        return $uri;
    }

    /*
    |-------------------------------------------------------------
    | * 获得完整的pathinfo数据
    |-------------------------------------------------------------
    | return array()
    res[path]
    res[query]
    |
    */
    public static function pathinfo_query_extend($key = null){
        $pathinfo = @parse_url(SELF::request_uri());
        /*
        /----------------------------------------------------
        | $key = ['path','query']
        |----------------------------------------------------
        | pathinfo
        |----------------------------------------------------
        |
        */
        $_path = explode('/', $pathinfo['path']);
        foreach($_path as $k=>$value){
            if(empty($value)) unset($_path[$k]);
        }
        $pathinfo['path'] = implode('/',$_path);

        /*
        /----------------------------------------------------
        | $key = ['path','query']
        |----------------------------------------------------
        | pathinfo
        |----------------------------------------------------
        |
        */
        $pq = array();
        $_query = array();

        if(!empty($pathinfo['query']))$_query = explode('&', $pathinfo['query']);
        foreach($_query as $k=>$value){
            //存在=号
            if(strpos($value,'=') !== false) {
                $p = explode('=', $value);
                if (isset($p[0])) {
                    $p[0] = urldecode($p[0]);
                }
                if (!empty($p[0]))
                    $pq[] = implode('=', $p);
            }
        }
        $pathinfo['query'] = implode('&', $pq);

        //-返回数据
        if(empty($key)){
            return $pathinfo;
        }else{
            return isset($pathinfo[$key])?$pathinfo[$key]:'';
        }
    }


    /*
     * 弃用
     * */
    public static function pathinfo_query()
    {
//        $pathinfo = @parse_url($_SERVER['REQUEST_URI']);
//        if (empty($pathinfo)) {
//            die('request parse error:' . $_SERVER['REQUEST_URI']);
//        }
//        //pathinfo模式下有?,那么$pathinfo['query']也是非空的，这个时候查询字符串是PATH_INFO和query
//        $query_str = empty($pathinfo['query']) ? '' : $pathinfo['query'];
//        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '');
////    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['REDIRECT_PATH_INFO']) ? $_SERVER['REDIRECT_PATH_INFO'] : '');
//        $pathinfo_query = empty($path_info) ? $query_str : $path_info . '&' . $query_str;
//        if ($pathinfo_query) {
//            $pathinfo_query = trim($pathinfo_query, '/&');
//        }
//
//        echo $pathinfo_query;
//
//        //urldecode 解码所有的参数名，解决get表单会编码参数名称的问题
//        $pq = $_pq = array();
//        $_pq = explode('&', $pathinfo_query);
//        foreach ($_pq as $value) {
//            $p = explode('=', $value);
//            if (isset($p[0])) {
//                $p[0] = urldecode($p[0]);
//            }
//            if(!empty($p[0]) || !empty($p[1]))  $pq[] = implode('=', $p);
//        }
//        $pathinfo_query = implode('&', $pq);
//        return $pathinfo_query;
    }

    /**
     * Array Access: Offset Exists
     */
    public function offsetExists($offset)
    {
        return isset($this->properties[$offset]);
    }
    /**
     * Array Access: Offset Get
     */
    public function offsetGet($offset)
    {
        if (isset($this->properties[$offset])) {
            return $this->properties[$offset];
        }
        return null;
    }
    /**
     * Array Access: Offset Set
     */
    public function offsetSet($offset, $value)
    {
        $this->properties[$offset] = $value;
    }
    /**
     * Array Access: Offset Unset
     */
    public function offsetUnset($offset)
    {
        unset($this->properties[$offset]);
    }
    /**
     * IteratorAggregate
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->properties);
    }


}