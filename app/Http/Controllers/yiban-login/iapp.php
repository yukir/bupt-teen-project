<?php
	/**
	 * 轻应用授权
	 *
	 */


	/**
	 * 包含SDK
	 */
	require("classes/yb-globals.inc.php");

	//配置文件
	require_once 'config.php';

	//初始化
	$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
	$iapp  = $api->getIApp();

	try {
	   //轻应用获取access_token，未授权则跳转至授权页面
	   $info = $iapp->perform();
	   if ($info == false) die();
	} catch (YBException $ex) {
	   echo $ex->getMessage();
	}

	$token = $info['visit_oauth']['access_token'];//轻应用获取的token
?>
