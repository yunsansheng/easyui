<?php
	session_start();
	if (!isset($_SESSION['admin'])) {
		header('location:login.html');
	}
?>

<!DOCTYPE html>
<html>
<title>主页</title>
<meta charset="UTF-8" />
<script type="text/javascript" src="jquery-easyui-1.4.3/jquery.min.js"></script>
<script type="text/javascript" src="jquery-easyui-1.4.3/jquery.easyui.min.js"></script>
<script type="text/javascript" src="jquery-easyui-1.4.3/locale/easyui-lang-zh_CN.js" ></script>
<link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.3/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.3/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="jquery-easyui-1.4.3/themes/addicon.css" />

<script type="text/javascript" src="js/home.js" charset="utf-8"></script> <!--homejs-->
<link rel="stylesheet" href="css/home.css" type="text/css" charset="utf-8"></link> <!--homecss-->


<script type="text/javascript" charset ="utf-8">

</script>


<style><!--内部样式-->

</style>

<body class="easyui-layout" >

    
	<div  id=north data-options="region:'north',split:true,border:false" style="height:50px;" >
	
	    <div class="logo"></div>  <!--logo-->
		<div class="logout">您好，<?php echo $_SESSION['admin']?> | <a href="logout.php">退出</a></div>
	
	</div>  
    
	
	
    <div data-options="region:'west',title:'导航菜单',split:true" style="width:130px">	        
			<ul id="nav"  >    
            </ul>
			
	</div>
	
    <div  data-options="region:'center',split:true" style="overflow:hidden;" >
		<div id="tabs" >
			<div title="起始页" iconcls="icon-house" style="padding:0 10px;">
				<h3>欢迎来到qsones管理系统！</h3>
			</div>
		</div>
	

	
	</div>

<!-- 
<script language="JavaScript">   <!--保留删除功能，禁用退回-->
	document.onkeydown = check();
	function check(e) {
		var code;
		if (!e) var e = window.event;
		if (e.keyCode) code = e.keyCode;
		else if (e.which) code = e.which;

	if (((event.keyCode == 8) &&                                                    //BackSpace 
			 ((event.srcElement.type != "text" && 
			 event.srcElement.type != "textarea" && 
			 event.srcElement.type != "password") || 
			 event.srcElement.readOnly == true)) || 
			((event.ctrlKey) && ((event.keyCode == 78) || (event.keyCode == 82)) ) ||    //CtrlN,CtrlR 
			(event.keyCode == 116) ) {                                                   //F5 
			event.keyCode = 0; 
			event.returnValue = false; 
		}

	return true;
	}
</script> -->
	
</body>
	
</html>