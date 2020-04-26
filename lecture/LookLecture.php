<?php /** For: 查看讲座页 * User: Lisa **/ ?>

<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>查看讲座信息</title>
    <link rel="stylesheet"  type="text/css" href="../css/style.css" >

    <style type="text/css">
    </style>
</head>
<body style="background-image: url('../image/background.jpg')">
<?php include "../top.php"; ?>

<div class="biao" align="center">
    <!--<div id="box">-->
    <!--    <div id="box_p">-->
    <p class="dabiaoti">查看讲座信息</p>
    <!--    </div>-->
    <table class="mt">
        <thead><tr>
            <td>讲座名称</td>
            <td>报名人数</td>
            <td>出勤率</td>
            <!--        <td>讲座名单</td>-->
        </tr></thead>
        <tbody>
        <?php 
        $query_lec="select lecname from lecture";
        $result_lec=execute($link, $query_lec);
        while($data=mysqli_fetch_assoc($result_lec)){
        	$rate_temp="暂无";
        	$query_par="select rate from participation where lecname='{$data['lecname']}'";
        	$result_par=execute($link, $query_par);
        	if($rate=mysqli_fetch_row($result_par)){
        		$rate_temp=floatval($rate[0])*100;
        		$rate_temp=(string)$rate_temp."%";
        	}
        	$lecDetail_url="LectureDetail.php?lecname={$data['lecname']}";
        	$html=<<<lookLec
        	<tr>
            	<td><a href="{$lecDetail_url}" target="_blank" style="font-family: 楷体;font-size:17px" >{$data['lecname']}</a> </form></td>
            	<td>150</td>
            	<td>{$rate_temp}</td>
        	</tr>
lookLec;
        	echo $html;
        }
        ?>
        </tbody>
    </table>
</div></div>
</body>
</html>
