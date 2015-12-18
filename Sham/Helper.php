<?php


//这里注意不要跟别的系统函数名冲突

//bus访问
//sapp('bus')['get'] ->bus('get')
//查看所有 bus()
//查看单个 bus('get')
//设置值   bus('get',$_get)


function saddslashes($string) {
      if(is_array($string)) {
            foreach($string as $key => $val) {
                  $string[$key] = saddslashes($val);
            }
      } else {
            $string = addslashes($string);
      }
      return $string;
}

    /*
    |------------------------------------------------------
    | @param $arr
    | 取代print_r()的条数函数
    |
    */
if (! function_exists('D')) {
      function D($arr = [])
      {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
            exit;
      }
}

/**
 * 终止程序运行
 * @param string $str 终止原因
 * @param bool $display 是否显示调用栈，默认不显示
 * @return void
 */
function halt($str){
      //Log::fatal($str.' debug_backtrace:'.var_export(debug_backtrace(), true));
      header("Content-Type:text/html; charset=utf-8");
      if(sc('debug')){
            echo "<pre>";
            debug_print_backtrace();
            echo "</pre>";
      }
      echo $str;
      exit;
}


if (! function_exists('shamhash')) {
      function shamhash($key = null,$salt = '')
      {
            //hash算法
            $key = "0000000000.$key.000000000.$salt";
            return md5($key);
      }
}

if (! function_exists('sapp')) {
      function sapp($make = null, $parameters = [])
      {
            if (is_null($make)) {
                  return Sham\Vo\Vo::getInstance();
            }
            return Sham\Vo\Vo::getInstance()->make($make, $parameters);
      }
}

if (! function_exists('geter')) {
      function geter($key = null)
      {
            $res =  Sham\Vo\Vo::getInstance()->make('geter')->get($key);
            return $res;
            //这里直接return 会报一个错误;
      }
}

if (! function_exists('vc')) {
      function vc($vo = null)      {
            if (is_null($vo)) {
                  return Sham\Vo\Vo::getInstance()->ObjectConfig;
            }
            return isset(Sham\Vo\Vo::getInstance()->ObjectConfig[$vo])?Sham\Vo\Vo::getInstance()->ObjectConfig[$vo]:[];
      }
}

/**
 * VoConfig
 */
if (! function_exists('config')) {
      function config($configTarget = null)
      {
            if (is_null($configTarget)) {
                  return array();
            }
            $config = Sham\Vo\Vo::getInstance()->make('config')->get($configTarget);
            return $config;
      }
}


/**
 * 如果文件存在就include进来
 * @param string $path 文件路径
 * @return void
 */
function includeIfExist($path){
      if(file_exists($path)){
            include $path;
      }
}

//转交控制权,给view对象

if (! function_exists('assign')) {
      function assign($key = null, $value = [])
      {
            return sapp('View')->assign($key, $value);
      }
}


if (! function_exists('view')) {
      function view($tpl = null, $data = [])
      {
            return sapp('View')->display($tpl, $data);
      }
}

      /*
      |--------------------------------------------------------------------------
      | 页面的widget
      |--------------------------------------------------------------------------
      |
      */
      function W($name, $data = array()){
            //
            $fullName = '\App\Widget\\'.ucfirst($name).'Widget';

            sapp('Ground')->widget($name);  //底层数据记录

            $widget = new $fullName();
            $widget->invoke($data);
      }

      //页面跳转
      function R($url, $time=0, $msg='') {
            $url = str_replace(array("\n", "\r"), '', $url);
            if (empty($msg))
                  $msg = "系统将在{$time}秒之后自动跳转到{$url}！";
            if (!headers_sent()) {
                  // redirect
                  if (0 === $time) {
                        header('Location: ' . $url);
                  } else {
                        header("refresh:{$time};url={$url}");
                        echo($msg);
                  }
                  exit();
            } else {
                  $str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
                  if ($time != 0)
                        $str .= $msg;
                  exit($str);
            }
      }

/*
|--------------------------------------------------------------------------
| 通用的方法 - print_r() 打印出设置的信息
|--------------------------------------------------------------------------
| 小写  sap sc
|
*/

//
//
//if (! function_exists('abort')) {
//      /**
//       * Throw an HttpException with the given data.
//       *
//       * @param  int     $code
//       * @param  string  $message
//       * @param  array   $headers
//       * @return void
//       *
//       * @throws \Symfony\Component\HttpKernel\Exception\HttpException
//       * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
//       */
//      function abort($code, $message = '', array $headers = [])
//      {
//            return app()->abort($code, $message, $headers);
//      }
//}
//
//if (! function_exists('action')) {
//      /**
//       * Generate a URL to a controller action.
//       *
//       * @param  string  $name
//       * @param  array   $parameters
//       * @param  bool    $absolute
//       * @return string
//       */
//      function action($name, $parameters = [], $absolute = true)
//      {
//            return app('url')->action($name, $parameters, $absolute);
//      }
//}
//
//
//if (! function_exists('app_path')) {
//      /**
//       * Get the path to the application folder.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function app_path($path = '')
//      {
//            return app('path').($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('asset')) {
//      /**
//       * Generate an asset path for the application.
//       *
//       * @param  string  $path
//       * @param  bool    $secure
//       * @return string
//       */
//      function asset($path, $secure = null)
//      {
//            return app('url')->asset($path, $secure);
//      }
//}
//
//if (! function_exists('auth')) {
//      /**
//       * Get the available auth instance.
//       *
//       * @return \Illuminate\Contracts\Auth\Guard
//       */
//      function auth()
//      {
//            return app('Illuminate\Contracts\Auth\Guard');
//      }
//}
//
//if (! function_exists('back')) {
//      /**
//       * Create a new redirect response to the previous location.
//       *
//       * @param  int    $status
//       * @param  array  $headers
//       * @return \Illuminate\Http\RedirectResponse
//       */
//      function back($status = 302, $headers = [])
//      {
//            return app('redirect')->back($status, $headers);
//      }
//}
//
//if (! function_exists('base_path')) {
//      /**
//       * Get the path to the base of the install.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function base_path($path = '')
//      {
//            return app()->basePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('bcrypt')) {
//      /**
//       * Hash the given value.
//       *
//       * @param  string  $value
//       * @param  array   $options
//       * @return string
//       */
//      function bcrypt($value, $options = [])
//      {
//            return app('hash')->make($value, $options);
//      }
//}
//
//if (! function_exists('config')) {
//      /**
//       * Get / set the specified configuration value.
//       *
//       * If an array is passed as the key, we will assume you want to set an array of values.
//       *
//       * @param  array|string  $key
//       * @param  mixed  $default
//       * @return mixed
//       */
//      function config($key = null, $default = null)
//      {
//            if (is_null($key)) {
//                  return app('config');
//            }
//
//            if (is_array($key)) {
//                  return app('config')->set($key);
//            }
//
//            return app('config')->get($key, $default);
//      }
//}
//
//if (! function_exists('config_path')) {
//      /**
//       * Get the configuration path.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function config_path($path = '')
//      {
//            return app()->make('path.config').($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('cookie')) {
//      /**
//       * Create a new cookie instance.
//       *
//       * @param  string  $name
//       * @param  string  $value
//       * @param  int     $minutes
//       * @param  string  $path
//       * @param  string  $domain
//       * @param  bool    $secure
//       * @param  bool    $httpOnly
//       * @return \Symfony\Component\HttpFoundation\Cookie
//       */
//      function cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
//      {
//            $cookie = app('Illuminate\Contracts\Cookie\Factory');
//
//            if (is_null($name)) {
//                  return $cookie;
//            }
//
//            return $cookie->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly);
//      }
//}
//
//if (! function_exists('csrf_field')) {
//      /**
//       * Generate a CSRF token form field.
//       *
//       * @return string
//       */
//      function csrf_field()
//      {
//            return new Illuminate\View\Expression('<input type="hidden" name="_token" value="'.csrf_token().'">');
//      }
//}
//
//if (! function_exists('csrf_token')) {
//      /**
//       * Get the CSRF token value.
//       *
//       * @return string
//       *
//       * @throws RuntimeException
//       */
//      function csrf_token()
//      {
//            $session = app('session');
//
//            if (isset($session)) {
//                  return $session->getToken();
//            }
//
//            throw new RuntimeException('Application session store not set.');
//      }
//}
//
//if (! function_exists('database_path')) {
//      /**
//       * Get the database path.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function database_path($path = '')
//      {
//            return app()->databasePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('delete')) {
//      /**
//       * Register a new DELETE route with the router.
//       *
//       * @param  string  $uri
//       * @param  \Closure|array|string  $action
//       * @return \Illuminate\Routing\Route
//       */
//      function delete($uri, $action)
//      {
//            return app('router')->delete($uri, $action);
//      }
//}
//
//if (! function_exists('elixir')) {
//      /**
//       * Get the path to a versioned Elixir file.
//       *
//       * @param  string  $file
//       * @return string
//       *
//       * @throws \InvalidArgumentException
//       */
//      function elixir($file)
//      {
//            static $manifest = null;
//
//            if (is_null($manifest)) {
//                  $manifest = json_decode(file_get_contents(public_path('build/rev-manifest.json')), true);
//            }
//
//            if (isset($manifest[$file])) {
//                  return '/build/'.$manifest[$file];
//            }
//
//            throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
//      }
//}
//
//if (! function_exists('env')) {
//      /**
//       * Gets the value of an environment variable. Supports boolean, empty and null.
//       *
//       * @param  string  $key
//       * @param  mixed   $default
//       * @return mixed
//       */
//      function env($key, $default = null)
//      {
//            $value = getenv($key);
//
//            if ($value === false) {
//                  return value($default);
//            }
//
//            switch (strtolower($value)) {
//                  case 'true':
//                  case '(true)':
//                        return true;
//
//                  case 'false':
//                  case '(false)':
//                        return false;
//
//                  case 'empty':
//                  case '(empty)':
//                        return '';
//
//                  case 'null':
//                  case '(null)':
//                        return;
//            }
//
//            if (Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
//                  return substr($value, 1, -1);
//            }
//
//            return $value;
//      }
//}
//
//if (! function_exists('event')) {
//      /**
//       * Fire an event and call the listeners.
//       *
//       * @param  string|object  $event
//       * @param  mixed  $payload
//       * @param  bool  $halt
//       * @return array|null
//       */
//      function event($event, $payload = [], $halt = false)
//      {
//            return app('events')->fire($event, $payload, $halt);
//      }
//}
//
//if (! function_exists('factory')) {
//      /**
//       * Create a model factory builder for a given class, name, and amount.
//       *
//       * @param  dynamic  class|class,name|class,amount|class,name,amount
//       * @return \Illuminate\Database\Eloquent\FactoryBuilder
//       */
//      function factory()
//      {
//            $factory = app('Illuminate\Database\Eloquent\Factory');
//
//            $arguments = func_get_args();
//
//            if (isset($arguments[1]) && is_string($arguments[1])) {
//                  return $factory->of($arguments[0], $arguments[1])->times(isset($arguments[2]) ? $arguments[2] : 1);
//            } elseif (isset($arguments[1])) {
//                  return $factory->of($arguments[0])->times($arguments[1]);
//            } else {
//                  return $factory->of($arguments[0]);
//            }
//      }
//}
//
//if (! function_exists('get')) {
//      /**
//       * Register a new GET route with the router.
//       *
//       * @param  string  $uri
//       * @param  \Closure|array|string  $action
//       * @return \Illuminate\Routing\Route
//       */
//      function get($uri, $action)
//      {
//            return app('router')->get($uri, $action);
//      }
//}
//
//if (! function_exists('info')) {
//      /**
//       * Write some information to the log.
//       *
//       * @param  string  $message
//       * @param  array   $context
//       * @return void
//       */
//      function info($message, $context = [])
//      {
//            return app('log')->info($message, $context);
//      }
//}
//
//if (! function_exists('logger')) {
//      /**
//       * Log a debug message to the logs.
//       *
//       * @param  string  $message
//       * @param  array  $context
//       * @return null|\Illuminate\Contracts\Logging\Log
//       */
//      function logger($message = null, array $context = [])
//      {
//            if (is_null($message)) {
//                  return app('log');
//            }
//
//            return app('log')->debug($message, $context);
//      }
//}
//
//if (! function_exists('method_field')) {
//      /**
//       * Generate a form field to spoof the HTTP verb used by forms.
//       *
//       * @param  string  $method
//       * @return string
//       */
//      function method_field($method)
//      {
//            return new Illuminate\View\Expression('<input type="hidden" name="_method" value="'.$method.'">');
//      }
//}
//
//if (! function_exists('old')) {
//      /**
//       * Retrieve an old input item.
//       *
//       * @param  string  $key
//       * @param  mixed   $default
//       * @return mixed
//       */
//      function old($key = null, $default = null)
//      {
//            return app('request')->old($key, $default);
//      }
//}
//
//if (! function_exists('patch')) {
//      /**
//       * Register a new PATCH route with the router.
//       *
//       * @param  string  $uri
//       * @param  \Closure|array|string  $action
//       * @return \Illuminate\Routing\Route
//       */
//      function patch($uri, $action)
//      {
//            return app('router')->patch($uri, $action);
//      }
//}
//
//if (! function_exists('policy')) {
//      /**
//       * Get a policy instance for a given class.
//       *
//       * @param  object|string  $class
//       * @return mixed
//       *
//       * @throws \InvalidArgumentException
//       */
//      function policy($class)
//      {
//            return app(Gate::class)->getPolicyFor($class);
//      }
//}
//
//if (! function_exists('post')) {
//      /**
//       * Register a new POST route with the router.
//       *
//       * @param  string  $uri
//       * @param  \Closure|array|string  $action
//       * @return \Illuminate\Routing\Route
//       */
//      function post($uri, $action)
//      {
//            return app('router')->post($uri, $action);
//      }
//}
//
//if (! function_exists('public_path')) {
//      /**
//       * Get the path to the public folder.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function public_path($path = '')
//      {
//            return app()->make('path.public').($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('put')) {
//      /**
//       * Register a new PUT route with the router.
//       *
//       * @param  string  $uri
//       * @param  \Closure|array|string  $action
//       * @return \Illuminate\Routing\Route
//       */
//      function put($uri, $action)
//      {
//            return app('router')->put($uri, $action);
//      }
//}
//
//if (! function_exists('redirect')) {
//      /**
//       * Get an instance of the redirector.
//       *
//       * @param  string|null  $to
//       * @param  int     $status
//       * @param  array   $headers
//       * @param  bool    $secure
//       * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
//       */
//      function redirect($to = null, $status = 302, $headers = [], $secure = null)
//      {
//            if (is_null($to)) {
//                  return app('redirect');
//            }
//
//            return app('redirect')->to($to, $status, $headers, $secure);
//      }
//}
//
//if (! function_exists('request')) {
//      /**
//       * Get an instance of the current request or an input item from the request.
//       *
//       * @param  string  $key
//       * @param  mixed   $default
//       * @return \Illuminate\Http\Request|string|array
//       */
//      function request($key = null, $default = null)
//      {
//            if (is_null($key)) {
//                  return app('request');
//            }
//
//            return app('request')->input($key, $default);
//      }
//}
//
//if (! function_exists('resource')) {
//      /**
//       * Route a resource to a controller.
//       *
//       * @param  string  $name
//       * @param  string  $controller
//       * @param  array   $options
//       * @return \Illuminate\Routing\Route
//       */
//      function resource($name, $controller, array $options = [])
//      {
//            return app('router')->resource($name, $controller, $options);
//      }
//}
//
//if (! function_exists('response')) {
//      /**
//       * Return a new response from the application.
//       *
//       * @param  string  $content
//       * @param  int     $status
//       * @param  array   $headers
//       * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
//       */
//      function response($content = '', $status = 200, array $headers = [])
//      {
//            $factory = app('Illuminate\Contracts\Routing\ResponseFactory');
//
//            if (func_num_args() === 0) {
//                  return $factory;
//            }
//
//            return $factory->make($content, $status, $headers);
//      }
//}
//
//if (! function_exists('route')) {
//      /**
//       * Generate a URL to a named route.
//       *
//       * @param  string  $name
//       * @param  array   $parameters
//       * @param  bool    $absolute
//       * @param  \Illuminate\Routing\Route  $route
//       * @return string
//       */
//      function route($name, $parameters = [], $absolute = true, $route = null)
//      {
//            return app('url')->route($name, $parameters, $absolute, $route);
//      }
//}
//
//if (! function_exists('secure_asset')) {
//      /**
//       * Generate an asset path for the application.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function secure_asset($path)
//      {
//            return asset($path, true);
//      }
//}
//
//if (! function_exists('secure_url')) {
//      /**
//       * Generate a HTTPS url for the application.
//       *
//       * @param  string  $path
//       * @param  mixed   $parameters
//       * @return string
//       */
//      function secure_url($path, $parameters = [])
//      {
//            return url($path, $parameters, true);
//      }
//}
//
//if (! function_exists('session')) {
//      /**
//       * Get / set the specified session value.
//       *
//       * If an array is passed as the key, we will assume you want to set an array of values.
//       *
//       * @param  array|string  $key
//       * @param  mixed  $default
//       * @return mixed
//       */
//      function session($key = null, $default = null)
//      {
//            if (is_null($key)) {
//                  return app('session');
//            }
//
//            if (is_array($key)) {
//                  return app('session')->put($key);
//            }
//
//            return app('session')->get($key, $default);
//      }
//}
//
//if (! function_exists('storage_path')) {
//      /**
//       * Get the path to the storage folder.
//       *
//       * @param  string  $path
//       * @return string
//       */
//      function storage_path($path = '')
//      {
//            return app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
//      }
//}
//
//if (! function_exists('trans')) {
//      /**
//       * Translate the given message.
//       *
//       * @param  string  $id
//       * @param  array   $parameters
//       * @param  string  $domain
//       * @param  string  $locale
//       * @return string
//       */
//      function trans($id = null, $parameters = [], $domain = 'messages', $locale = null)
//      {
//            if (is_null($id)) {
//                  return app('translator');
//            }
//
//            return app('translator')->trans($id, $parameters, $domain, $locale);
//      }
//}
//
//if (! function_exists('trans_choice')) {
//      /**
//       * Translates the given message based on a count.
//       *
//       * @param  string  $id
//       * @param  int     $number
//       * @param  array   $parameters
//       * @param  string  $domain
//       * @param  string  $locale
//       * @return string
//       */
//      function trans_choice($id, $number, array $parameters = [], $domain = 'messages', $locale = null)
//      {
//            return app('translator')->transChoice($id, $number, $parameters, $domain, $locale);
//      }
//}
//
//if (! function_exists('url')) {
//      /**
//       * Generate a url for the application.
//       *
//       * @param  string  $path
//       * @param  mixed   $parameters
//       * @param  bool    $secure
//       * @return string
//       */
//      function url($path = null, $parameters = [], $secure = null)
//      {
//            return app('Illuminate\Contracts\Routing\UrlGenerator')->to($path, $parameters, $secure);
//      }
//}
//
//if (! function_exists('view')) {
//      /**
//       * Get the evaluated view contents for the given view.
//       *
//       * @param  string  $view
//       * @param  array   $data
//       * @param  array   $mergeData
//       * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
//       */
//      function view($view = null, $data = [], $mergeData = [])
//      {
//            $factory = app('Illuminate\Contracts\View\Factory');
//
//            if (func_num_args() === 0) {
//                  return $factory;
//            }
//
//            return $factory->make($view, $data, $mergeData);
//      }
//}



//sc 即将弃用
// ->
// dc  环境
// sc  底端数据
// bus 前
// vc - 对象配置
if (! function_exists('sc')) {
      function sc($key = '', $value = array())
      {

            $args = func_num_args();
            $wise = Sham\Wise\Wise::getInstance();


            //1 : 返回配置信息
            if ($args == 0) {
                  return $wise->_config;
            }

            //2 : 有一个参数
            if ($args == 1) {

                  if (is_string($key)) {  //如果传入的key是字符串
                        return isset($wise->_config[$key]) ? $wise->_config[$key] : null;
                  }
                  if (is_array($key)) {
                        if (array_keys($key) !== range(0, count($key) - 1)) {  //如果传入的key是关联数组
                              $wise->_config = array_merge($wise->_config, $key);
                        } else {
                              $ret = array();
                              foreach ($key as $k) {
                                    $ret[$k] = isset($wise->_config[$k]) ? $wise->_config[$k] : null;
                              }
                              return $ret;
                        }
                  }

            } else {
                  //设置一个值
                  if (is_string($key)) {
                        $wise->_config[$key] = $value;
                  }
                  //else {
//                        halt('传入参数不正确');
//                  }
            }
            return null;
      }
}


if (! function_exists('dc')) {
      function dc($key = '', $value = array())
      {
            $args = func_num_args();

            //1 : 返回配置信息
            if ($args == 0) {
                  return Sham\Wise\Wise::getInstance()->_configdc;
            }

            //2 : 有一个参数
            if ($args == 1) {

                  if (is_string($key)) {  //如果传入的key是字符串
                        return isset(Sham\Wise\Wise::getInstance()->_configdc[$key]) ? Sham\Wise\Wise::getInstance()->_configdc[$key] : null;
                  }
                  if (is_array($key)) {
                        if (array_keys($key) !== range(0, count($key) - 1)) {  //如果传入的key是关联数组
                              Sham\Wise\Wise::getInstance()->_configdc = array_merge(Sham\Wise\Wise::getInstance()->_configdc, $key);
                        } else {
                              $ret = array();
                              foreach ($key as $k) {
                                    $ret[$k] = isset(Sham\Wise\Wise::getInstance()->_configdc[$k]) ? Sham\Wise\Wise::getInstance()->_configdc[$k] : null;
                              }
                              return $ret;
                        }
                  }

            } else {
                  //设置一个值
                  if (is_string($key)) {
                        Sham\Wise\Wise::getInstance()->_configdc[$key] = $value;
                  }
                  //else {
//                        halt('传入参数不正确');
//                  }
            }
            return null;
      }
}

if (! function_exists('bus')) {
      function bus($key = '', $value = array())
      {
            $args = func_num_args();

            //1 : 返回配置信息
            if ($args == 0) {
                  return Sham\Wise\Wise::getInstance()->_configbus;
            }

            //2 : 有一个参数
            if ($args == 1) {

                  if (is_string($key)) {  //如果传入的key是字符串
                        return isset(Sham\Wise\Wise::getInstance()->_configbus[$key]) ? Sham\Wise\Wise::getInstance()->_configbus[$key] : null;
                  }
                  if (is_array($key)) {
                        if (array_keys($key) !== range(0, count($key) - 1)) {  //如果传入的key是关联数组
                              Sham\Wise\Wise::getInstance()->_configbus = array_merge(Sham\Wise\Wise::getInstance()->_configbus, $key);
                        } else {
                              $ret = array();
                              foreach ($key as $k) {
                                    $ret[$k] = isset(Sham\Wise\Wise::getInstance()->_configbus[$k]) ? Sham\Wise\Wise::getInstance()->_configbus[$k] : null;
                              }
                              return $ret;
                        }
                  }

            } else {
                  //设置一个值
                  if (is_string($key)) {
                        Sham\Wise\Wise::getInstance()->_configbus[$key] = $value;
                  }
                  //else {
//                        halt('传入参数不正确');
//                  }
            }
            return null;
      }
}