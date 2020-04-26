<?php /** For: 讲座详情页 删除操作 * User: Lisa **/ ?>

<?php 
var_dump($_REQUEST);
$lecname=$_REQUEST['lecname'];
var_dump($lecname);
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$query_delete="delete from lecture where lecname='{$lecname}'";
execute($link,$query_delete);
if(mysqli_affected_rows($link)==1){
	echo "恭喜你删除成功！";
}else{
	echo "对不起删除失败，请重试！";
}
Header("Location: LookLecture.php");
//exit();
?>