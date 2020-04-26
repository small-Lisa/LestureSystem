<?php /** For: 讲座详情页 * User: Lisa **/ ?>

<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$query_lecture = "select * from lecture where lecname='{$_GET['lecname']}'";
$query_apportion = "select * from apportion where lecname='{$_GET['lecname']}'";
$result_lecture = execute($link, $query_lecture);
$result_apportion = execute($link, $query_apportion);
$data_lecture = mysqli_fetch_assoc($result_lecture);
//$data_apportion = mysqli_fetch_all($result_apportion);
//var_dump($data_lecture);
//var_dump($data_apportion);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>讲座详情</title>
    <link rel="stylesheet"  type="text/css" href="../css/style.css" >
    <style>
        .duiqi *{display:inline-block;vertical-align:middle}
    </style>
</head>
<body style="background-image: url('../image/background.jpg')">
<?php include "../top.php"; ?>
<div class="biao">
<?php
$html_biao1one=<<<biao1_one
    <div align="left" class="biao1" >
        <p align="center" class="dabiaoti">讲座详情</p>
        <fieldset align="left" style="font-family:'楷体'; font-color:black;font-size:20px;opacity: 1;">
            <p style="font-size: 18px">讲座标题：{$_GET['lecname']}
                <br>
                讲座地点：{$data_lecture['lecplace']}
            </p>
            <p style="font-size: 18px">
                讲座时间：{$data_lecture['lectime']}
                <br>
                申请截止时间：{$data_lecture['firstddl']}
            </p>
            <p style="font-size: 18px">
                主要内容:<br>
      &nbsp&nbsp&nbsp{$data_lecture['lecmess']}
            </p>
            <p style="font-size: 18px">
                班级分配名额：
            <table style="border:1px solid;">
                <thead>
                <tr align="center">
                    <th>&nbsp&nbsp</th><th>班级</th><th>&nbsp&nbsp</th><th>名额</th><th>&nbsp&nbsp</th>
                </tr>
                </thead>
    			<tbody>
biao1_one;
	echo $html_biao1one;
?>
<?php
	while($data_apportion = mysqli_fetch_assoc($result_apportion)){
$html_biao1two=<<<biao1_two
    			<tr style="border-color:dodgerblue">
                    <td>&nbsp&nbsp&nbsp&nbsp</td>
                    <td>{$data_apportion['classname']}</td>
                    <td>&nbsp&nbsp&nbsp&nbsp</td>
                    <td>{$data_apportion['apportnum']}</td>
                    <td>&nbsp&nbsp&nbsp&nbsp</td>
                </tr>
biao1_two;
		echo $html_biao1two;
	}
?>
<?php
$html_biao1three=<<<biao1_three
				</tbody>
            </table>
            </p>
        </fieldset><br>
        <div align="center"class="duiqi">
            <form method="post" action="LectureDetail_modify.php?lecname={$_GET['lecname']}">
				<input type="hidden" value="{$_GET['lecname']}" style="width:62px">
				<input type="submit" value="修改" style="width:62px">
                &nbsp&nbsp&nbsp&nbsp&nbsp
            </form>
            <form method="post" action="LectureDetail_delete.php?lecname={$_GET['lecname']}">
				<input type="submit" value="删除" style="width:62px">
                &nbsp&nbsp&nbsp&nbsp
            </form>
        </div>
    </div>
biao1_three;
    echo $html_biao1three;
?>
    <div class="biao2" align="right"><br><br>
        <b><p class="dabiaoti" align="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p></b><br>
        <table class="mt" style="width: 550px;margin: -15px 20px 20px -30px;">
            <thead>
            	<tr align='center'><td>姓名</td><td>学号</td><td>班级</td><td>是否出席</td><td>删除</td></tr>
            </thead>
            <tbody>
            <?php 
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
$html_mingdan=<<<mingdan
			<tr align='center'>
            		<td>{$data_student['stuname']}</td>
            		<td>{$data_student['stuid']}</td>
            		<td>{$data_student['classname']}</td>
            		<td>{$isDone}</td>
            		<td><a href='LectureDetail_deleteList.php?lecname={$data_lecture['lecname']}&stuid={$data_student['stuid']}'><img src='../image/shanchu.png' width='15px' height='15px'></a></td>
            </tr>
mingdan;
            	echo $html_mingdan;
            }
            ?>
            	
            </tbody>
        </table>
        <table>
            <tr class="duiqi" align="center">
                <td>&nbsp
                    <form target="w" action="">
                        <input type="submit" value="生成二维码" style="width:120px">
                        &nbsp&nbsp&nbsp&nbsp
                    </form>
                </td>
                <td >
                	<form method="post" target="_blank" action="LectureDetail_exportList.php?lecname=<?php echo $_GET['lecname'];?>">
                		&nbsp&nbsp&nbsp&nbsp
						<input type="submit" value="导出名单"style="width:120px" align="right">
            		</form>
                </td>

            </tr>
        </table>
    </div>
    
</div>
</body>
</html>