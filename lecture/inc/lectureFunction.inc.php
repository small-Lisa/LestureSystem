<?php
function lectureDetail_delete($lecname){
	//var_dump($_REQUEST);
	//$lecname=$_REQUEST['lecname'];
	var_dump($lecname);
	include_once 'C:/wamp64/www/LecSystem/inc/config.inc.php';
	include_once 'C:/wamp64/www/LecSystem/inc/mysql.inc.php';
	$link=connect();
	$query_delete="delete from lecture where lecname='{$lecname}'";
	execute($link,$query_delete);
	if(mysqli_affected_rows($link)==1){
		echo "恭喜你删除成功！";
	}else{
		echo "对不起删除失败，请重试！";
	}
	sleep(5);
	Header("Location: LookLecture.php");
	exit();
}
?>