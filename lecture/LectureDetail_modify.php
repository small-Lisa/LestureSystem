<?php /** For: 讲座详情页   修改操作* User: Lisa **/?>

<?php
//var_dump($_REQUEST);
$lecname=$_REQUEST['lecname'];
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
$link=connect();
$query_lecture = "select * from lecture where lecname='{$lecname}'";
$query_apportion = "select * from apportion where lecname='{$lecname}'";
$result_lecture = execute($link, $query_lecture);
$result_apportion = execute($link, $query_apportion);
$data_lecture = mysqli_fetch_assoc($result_lecture);
//var_dump($data_lecture);
//var_dump($result_apportion);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>修改讲座</title>
    <link rel="stylesheet"  type="text/css" href="../css/style.css" >
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <script>
    //名额分配
    $(document).ready(function(){
    	$("#tianjia").click(function(){
    		var chooseClass=$("input[name='chooseClass']").val();
    		var chooseNum=$("input[name='chooseNum']").val();
    		if(chooseClass=="" || chooseNum==""){
				//alert("请输入正确的班级和名额数目！");
    			$("#tianjia").after("<br><font style='font-size:15px;'>请输入正确的班级和名额数目！</font>");
        	}else{
	    		var apporteMess=$("input[name='apporteMess']").val();
	    		$htmlTr="<tr align='center'><td>&nbsp&nbsp&nbsp&nbsp</td>"+
				"<td>"+chooseClass+"</td>"+
				"<td>&nbsp&nbsp&nbsp&nbsp</td>"+
				"<td>"+chooseNum+"</td>"+
				"<td><a id='shanchu' style='font-size:15px'><img src='../image/shanchu.png' width='15px' height='15px'></a></td>"+
				"</tr>";
				$("#tabbody").append($htmlTr);
				$("input[name='chooseClass']").val("");
				$("input[name='chooseNum']").val("");
				apporteMess=apporteMess+chooseClass+"#"+chooseNum+"&";
				$("input[name='apporteMess']").val(apporteMess);
				$("#tabbody").trigger("create"); 
        	}
    	});
    })
    $(function () {
   		$(document).on("click", "#shanchu", function () {
			var deleteClass=$(this).parents('tr').find('td').eq(1).text();
			var deleteNum=$(this).parents('tr').find('td').eq(3).text();
        	var apporteMess=$("input[name='apporteMess']").val();
			var deleteMess=deleteClass+"#"+deleteNum+"&";
			apporteMess=apporteMess.replace(deleteMess,"");
        	$("input[name='apporteMess']").val(apporteMess);
        	$(this).parents('tr').empty();
        	$("#tabbody").trigger("create");
    	});
	});
	//检查表单的值是否为空，为空不能提交
	function isEmptyInput(form){
		//alert(form.length);
		for(i=0; i<form.length-4; i++){
			if(form.elements[i].value == ""){
				form.elements[i].focus();
				return false;
			}
		}
	}
    </script>
</head>
<body style="background-image: url('../image/background.jpg')">
<?php include "../top.php"; ?>
<div class="biao" align="center" style="padding:30px 60px 30px 60px;margin-bottom: 20px">
    <p class="dabiaoti">修改讲座信息</p>
    <form id="lecDetail_modify" method="post" action="LectureDetail_modify_tool.php" onsubmit="return isEmptyInput(this)" style="margin:20px; opacity:1; font-weight:bold;">
        <fieldset align="left" style="font-family:'楷体'; font-color:black;font-size:20px;">
            <div align="center"><br><br>
            <?php 
            //处理时间显示
			$lectime=$data_lecture['lectime'];
           	$lectime_temp=str_replace(" ", "T", $lectime);
           	$firstddl=$data_lecture['firstddl'];
           	$firstddl_temp=str_replace(" ", "T", $firstddl);
$htmlMess=<<<lecMess
                <p>讲座标题：<input type="text" name="lecname" value="{$data_lecture['lecname']}" readonly="readonly"></input>
        		<font style='color:blue; font-size:10px;'>名称不可修改！&nbsp&nbsp</font>            
                    讲座地点：<input type="text" name="lecplace" value="{$data_lecture['lecplace']}"></input>
                </p>
                <p>
                    讲座时间：<input type="datetime-local" name="lectime" value="{$lectime_temp}"></input>
                    &nbsp&nbsp&nbsp&nbsp
                    申请截止时间：<input type="datetime-local" name="firstddl" value="{$firstddl_temp}"></input>
                </p><br>
                <p>主要内容:<br><textarea rows="5" cols="80" name="lecmess" id="lecmess" value="{$data_lecture['lecmess']}" style="background-color: rgba(255,255,255,0.85);border:1px solid;">{$data_lecture['lecmess']}</textarea>
                </p><br>
lecMess;
            echo $htmlMess;
           	?>
                班级分配名额：
                                          班级<input type="text" name="chooseClass" list="choose" style="border-bottom:1px solid"></input>
                <datalist id="choose">
				<?php 
                	$query_class = "select classname from class";
                	$result_class = execute($link, $query_class);
                	while($data_class = mysqli_fetch_assoc($result_class)){
$html_biao1two=<<<option
						<option>{$data_class['classname']}</option>
option;
                		echo $html_biao1two;
                	}
                ?>
                </datalist>
                                          名额<input type="text" name="chooseNum" style="width:40px;border-bottom:1px solid">
                <a id='tianjia' style='font-size:15px'>[添加]</a>
                
                <table style="border:1px solid;background-color:rgba(255,255,255,0.85);" class="fp">
                    <thead>
                    <tr align="center">
                        <th>&nbsp&nbsp</th><th>班级</th><th>&nbsp&nbsp</th><th>名额</th><th>&nbsp&nbsp</th>
                    </tr>
                    </thead>
                    <tbody class="fp" id="tabbody">
                    <?php
                    $apporteMess="&";
                    while($data_apportion = mysqli_fetch_assoc($result_apportion)){
                    	$apporteMess=$apporteMess.$data_apportion['classname']."#".$data_apportion['apportnum']."&";
$htmlTr=<<<hang
					<tr align="center">
                        <td>&nbsp&nbsp&nbsp&nbsp</td>
                        <td>{$data_apportion['classname']}</td>
                        <td>&nbsp&nbsp&nbsp&nbsp</td>
                        <td>{$data_apportion['apportnum']}</td>
                        <td><a id='shanchu' style='font-size:15px'><img src='../image/shanchu.png' width='15px' height='15px'></a></td>
                    </tr>
hang;
                        echo $htmlTr;
                    }
                    ?>
                    <!-- jquery添加html的行 -->
                    </tbody>
                </table>
                </p></div><br>
                <input type="hidden" name="apporteMess" value="<?php echo $apporteMess;?>"></input>
            <p align="center">
                <input type="submit" value="确认修改"></input>
            </p><br>
        </fieldset>
    </form>
</div>
</body>
</html>