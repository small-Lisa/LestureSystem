<<<<<<< HEAD
<?php/** For: 导航栏 * User: Lisa **/ ?>
<?php 
$url=$_SERVER['SCRIPT_NAME'];//获取访问的页面地址LecSystem/...?
$url=explode("/", $url);
$url=$url[3];//取得页面地址
$inputLec_url="inputLecture.php";
$lookLec_url="LookLecture.php";
$inputStu_url="inputStudent.php";
$lookStu_url="LookStudent.php";
$advice_url="Advice.php";
$picSet_url="PictureSet.php";
function show($url,$toUrl){
	if($url==$toUrl)
		echo "text-decoration:none";
	else
		echo "href='".$toUrl."' target='_blank' class='change'";
}
?>
<div class="logo">
    <img src="../image/logo.png">
</div>
</p></div>
<div class="top">
<ul>
    <li><a href="../index.php">主页</a> </li>
    <li>
        <a>讲座信息</a>
        <ul>
            <li><a <?php show($url,$inputLec_url)?>>发布讲座信息</a></li>
            <li><a <?php show($url,$lookLec_url)?>>查看讲座信息</a></li>            
        </ul>
    </li>
    <li>
        <a>学生信息</a>
        <ul>
            <li><a <?php show($url,$inputStu_url)?>>导入学生信息</a></li>
            <li><a <?php show($url,$lookStu_url)?>>查看学生信息</a></li>
        </ul>
    </li>
    <li>
        <a>其他功能</a>
        <ul>
            <li><a <?php show($url,$advice_url)?>>意见箱</a></li>
            <li><a <?php show($url,$picSet_url)?>>图片放置</a></li>
        </ul>
</ul>
=======
<?php/** For: 导航栏 * User: Lisa **/ ?>
<?php 
$url=$_SERVER['SCRIPT_NAME'];//获取访问的页面地址LecSystem/...?
$url=explode("/", $url);
$url=$url[3];//取得页面地址
$inputLec_url="inputLecture.php";
$lookLec_url="LookLecture.php";
$inputStu_url="inputStudent.php";
$lookStu_url="LookStudent.php";
$advice_url="Advice.php";
$picSet_url="PictureSet.php";
function show($url,$toUrl){
	if($url==$toUrl)
		echo "text-decoration:none";
	else
		echo "href='".$toUrl."' target='_blank' class='change'";
}
?>
<div class="logo">
    <img src="../image/logo.png">
</div>
</p></div>
<div class="top">
<ul>
    <li><a href="../index.php">主页</a> </li>
    <li>
        <a>讲座信息</a>
        <ul>
            <li><a <?php show($url,$inputLec_url)?>>发布讲座信息</a></li>
            <li><a <?php show($url,$lookLec_url)?>>查看讲座信息</a></li>            
        </ul>
    </li>
    <li>
        <a>学生信息</a>
        <ul>
            <li><a <?php show($url,$inputStu_url)?>>导入学生信息</a></li>
            <li><a <?php show($url,$lookStu_url)?>>查看学生信息</a></li>
        </ul>
    </li>
    <li>
        <a>其他功能</a>
        <ul>
            <li><a <?php show($url,$advice_url)?>>意见箱</a></li>
            <li><a <?php show($url,$picSet_url)?>>图片放置</a></li>
        </ul>
</ul>
>>>>>>> f1b03ff... 提交文件
</div>