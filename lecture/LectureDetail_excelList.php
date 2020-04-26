<?php /** For: 讲座详情页 下载Excel名单 * User: Lisa **/ ?>

<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$filename = $_GET['lecname'].'_名单.xlxs';
$extraMessage = '';
# 获取名单相关信息
$query_lecwithstu = "select * from lecwithstu where lecname='{$_GET['lecname']}' and isLucky=1";
$result_lecwithstu = execute($link, $query_lecwithstu);
$html_mingdan = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
$html_mingdan .= "<table border=1>";
$html_mingdan .= "<tr align='center'><td>姓名</td><td>学号</td><td>班级</td><td>是否出席</td></tr>\n";
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
				$html_mingdan .= "<tr align='center'><td>{$data_student['stuname']}</td><td>{$data_student['stuid']}</td><td>{$data_student['classname']}</td><td>{$isDone}</td></tr>\n";		
}
echo $html_mingdan;
if (!empty($extraMessage)){
	$html_mingdan .= "<tr style='height:50px;border-style:none;'><th border=\"0\" style='height:60px;width:270px;font-size:22px;' colspan='19' >{$extraMessage}</th></tr>";
}
$html_mingdan .= "</table></body></html>";
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $filename);
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/download");;
header("Pragma: no-cache");
header("Expires: 0");
exit($html_mingdan);
