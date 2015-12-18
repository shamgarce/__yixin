<?php
namespace Sham\Widget;

//use Sham\Set\Set;

/**
 * Widget类
 * 使用时需继承此类，重写invoke方法，并在invoke方法中调用display
 */
class Widget {
      /**
       * 视图实例
       * @var View
       */
      protected $_view;
      protected $_data;
      /**
       * Widget名
       * @var string
       */
      protected $_widgetName;

      /**
       * 构造函数，初始化视图实例
       */
      public function __construct(){
            $this->_widgetName = str_replace('App\Widget\\','',get_class($this));
            $this->_tplDir = APPROOT.'Widget/Tpl/';
      }

      /**
       * 处理逻辑
       * @param mixed $data 参数
       */
      public function invoke($data){}

      /**
       * 渲染模板
       * @param string $tpl 模板路径，如果为空则用类名作为模板名
       */
      protected function display($tpl='',$data = array()){
            $this->_data = array();
            foreach($data as $key=>$value){
                  $this->_data[$key] = $value;
            }

            if($tpl == ''){
                  $tpl = $this->_widgetName;
            }

            $tplfile = $this->_tplDir.$tpl.'.php';

            extract($this->_data);
            include $tplfile;


      }

      /**
       * 为视图引擎设置一个模板变量
       * @param string $name 要在模板中使用的变量名
       * @param mixed $value 模板中该变量名对应的值
       * @return void
       */
      protected function assign($key,$value){
            $this->_data[$key] = $value;
      }
}