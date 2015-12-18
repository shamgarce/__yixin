<?php
//---------------------------------------------------
//载入Sham\Wise

include("../Sham/Helper.php");
include("../vendor/autoload.php");
//---------------------------------------------------
define('APPROOT','../App/');
App\Application::run();

//所有请求都请求道 Application::RUN 下面
