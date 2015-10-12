<style>
	.continer{
		margin: 50px;
	}
</style>
<!-- href="http://www.baidu.com" -->
<div class="continer">
	<h3>验证成功后，可点击按钮打开界面</h3>


	<div id="target_login">
		<p>用户：<input type="text" id="username" ></p>
		<p>密码：<input type="password" id="password" ></p>
	</div>


	<a id="target_btn" style="margin-left:10px;" >用户验证</a>
	<a  id="topage" href="http://www.qsones.com/target_long.php"  target="_blank" style="margin-left:40px;">点击跳转</a>
</div>

<script>
	 $(function () {

 $('#topage').linkbutton({
 	disabled:true,
 });
 $('#target_btn').linkbutton({

 });

	// //登录界面
	// $('#target_login').dialog({
	// 	title : '打开需要验证密码',
	// 	width : 350,
	// 	height : 225,
	// 	buttons : '#target_btn',
	// 	closable:false,
	// 	closed: false,
	// 	draggable:false,
	// 	// modal:true,
	// });
	// // $('#target_login').dialog('center');
	

	// //管理员帐号验证
	// $('#username').textbox({
	// 	width:220,
	// 	height:30,
	// 	icons: [{
	// 			iconCls:'icon-man',
	// 	}],
	// 	iconAlign:'left',

	// });
	
	// //管理员密码验证
	// $('#password').textbox({
	// 	width:220,
	// 	height:30,
	// 	icons: [{
	// 			iconCls:'icon-lock',

	// 	}],
	// 	iconAlign:'left',
	// });
	
	// $('#password').textbox('resize');


	
	//单击登录
	$('#target_btn').click(function () {

			$.ajax({
				url : 'checklogin.php',
				type : 'post',
				data : {
					username : $('#username').val(),
					password : $('#password').val(),
				},
				beforeSend : function () {
					$.messager.progress({
						text : '正在登录中...',
					});
				},
				success : function (data, response, status) {
					$.messager.progress('close');
					
					if (data > 0) {
						$('#topage').linkbutton('enable');



					} else {
						$.messager.alert('登录失败！', '用户名或密码错误！', 'warning', function () {
							$('#password').select();
						});
					}
				}
			});
	});


	
 });



</script>
