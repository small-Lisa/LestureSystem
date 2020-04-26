<?php /** For: 讲座详情页 删除某个名单 * User: Lisa **/ ?>

<?php
var_dump($_GET);
$lecname = $_GET['lecname'];
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$query_lecwithstu = "delete from lecwithstu where lecname='{$lecname}' and stuid='{$_GET['stuid']}'";
execute($link,$query_lecwithstu);
if(mysqli_affected_rows($link)==1){
	echo "恭喜你删除成功！";
}else{
	echo "对不起删除失败，请重试！";
}
header("Location: LectureDetail.php?lecname=".$lecname);
exit();