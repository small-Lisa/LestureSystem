<?php
var_dump($_POST);
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
//相关函数
//将datetime-local获取到的数据转换成格式为mysql的datetime类型数据
function changeTime($str){
	$timeArr=explode("T", $str);
	$timeStr=$timeArr[0]." ".$timeArr[1];
	$time=date("Y-m-d H:i:s" ,strtotime($timeStr));
	return $time;
}
//表单post取值
$lecname=$_POST['lecname'];
$lecplace=$_POST['lecplace'];
$lectime=$_POST['lectime'];
$firstddl=$_POST['firstddl'];
$lecmess=$_POST['lecmess'];
$apporteMess=$_POST['apporteMess'];
//测试


//secondddl的设置(利用lectime减去30分钟)
$lectime=changeTime($lectime);
$lectime_temp=date_create($lectime);
date_sub($lectime_temp,date_interval_create_from_date_string("30 minutes"));
$secondddl=$lectime_temp->format("Y-m-d H:i:s");

//将apporteMess转换成array存值
$apporteArr=explode("&", $apporteMess);
var_dump($apporteArr);
array_shift($apporteArr);
array_pop($apporteArr);


//构造sql语句
$query_lec="insert into lecture(lecname,lectime,lecplace,lecmess,firstddl,secondddl) value('{$lecname}','{$lectime}','{$lecplace}','{$lecmess}','{$firstddl}','{$secondddl}')";
$len=count($apporteArr);
$queryArr=array(
		$query_lec,
);
for($i=0; $i<$len; $i++){
	$classArr=explode("#", $apporteArr[$i]);
	$classname=$classArr[0];
	$classnum=$classArr[1];
	$query_app="insert into apportion(lecname,classname,apportnum) value('{$lecname}','{$classname}',{$classnum})";
	array_push($queryArr, $query_app);
}


//存入数据 表lecture和表apportion
execute_multi($link,$queryArr,$error);
var_dump($error);
Header("Location: LectureDetail.php?lecname={$lecname}");
exit();


