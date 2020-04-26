<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$query_lecwithstu = "select * from lecwithstu where lecname='学业生涯之精算师' and isLucky=1";
$result_lecwithstu = execute($link, $query_lecwithstu);
while($data_lecwithstu = mysqli_fetch_assoc($result_lecwithstu)){
	if($data_lecwithstu['isDone']==1){
		$isDone = '是';
    }else{	$isDone = '否';}
    $query_student = "select * from student where stuid='{$data_lecwithstu['stuid']}'";
    $result_student = execute($link, $query_student);
    $data_student = mysqli_fetch_assoc($result_student);
    $mingdan = "姓名：{$data_student['stuname']}     学号：{$data_student['stuid']}   班级：{$data_student['classname']}   是否参加：{$isDone}";
    var_dump($mingdan);
}

