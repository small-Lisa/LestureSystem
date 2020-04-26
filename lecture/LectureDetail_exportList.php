<?php /** For: 讲座详情页 导出讲座名单 * User: Lisa **/ ?>

<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>讲座名单</title>
    <style>
    .tab{
    	
    }
    .but{
    	
    }
    </style>
</head>
<body>
<div align="center"><br>
<form method="post" action="LectureDetail_excelList.php?lecname=<?php echo $_GET['lecname'];?>" target="_blank">
	<input class="but" type="submit" value="下载excel表格">
</form>
<br>
<h><?php echo $_GET['lecname'];?></h><br><br>
<table class="tab" border="1" cellspacing="0" bordercolor="#000000" width="50%" style="border-collapse:collapse;">
<thead>
	<tr align='center'><td>姓名</td><td>学号</td><td>班级</td><td>是否出席</td></tr>
</thead>
<tbody>
<?php
# 获取名单相关信息
$query_lecwithstu = "select * from lecwithstu where lecname='{$_GET['lecname']}' and isLucky=1";
$result_lecwithstu = execute($link, $query_lecwithstu);
while($data_lecwithstu = mysqli_fetch_assoc($result_lecwithstu)){
	$isDone = '';
	if($data_lecwithstu['isDone']==1)
		$isDone = '是';
    if($data_lecwithstu['isDone']==0)
    	$isDone = '否';
    if($data_lecwithstu['isDone']==null)
    	$isDone = '';
    $query_student = "select * from student where stuid='{$data_lecwithstu['stuid']}'";
    $result_student = execute($link, $query_student);
    $data_student = mysqli_fetch_assoc($result_student);
    $html_mingdan = "<tr align='center'><td>{$data_student['stuname']}</td><td>{$data_student['stuid']}</td><td>{$data_student['classname']}</td><td>{$isDone}</td></tr>";
    echo $html_mingdan;
}
# 
?>
</tbody></table>
</div>
</body></html>