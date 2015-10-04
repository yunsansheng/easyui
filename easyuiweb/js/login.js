$(function () {


	//单击enter登录
	$('body').keydown(function (e) {
		//alert(e.which);
		if(e.which ==13){
			$('#btn').click();
		}
	});


	
	//登录界面
	$('#login').dialog({
		title : '登录管理系统',
		width : 350,
		height : 225,
		buttons : '#btn',
		closable:false,
		closed: false,
		draggable:false,

	});
	$('#login').dialog('center');
	

	//管理员帐号验证
	$('#username').textbox({
		width:220,
		height:30,
		icons: [{
				iconCls:'icon-man',
		}],
		iconAlign:'left',

	});
	
	//管理员密码验证
	$('#password').textbox({
		width:220,
		height:30,
		icons: [{
				iconCls:'icon-lock',

		}],
		iconAlign:'left',
	});
	

	
	//单击登录
	$('#btn').click(function () {

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
						location.href = 'home.php';
					} else {
						$.messager.alert('登录失败！', '用户名或密码错误！', 'warning', function () {
							$('#password').select();
						});
					}
				}
			});
	});
	
});








