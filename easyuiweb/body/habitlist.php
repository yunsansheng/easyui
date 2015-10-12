
<?php 
	session_start();
 ?>

<!--htmlbody代码部分-->


	<div style="margin-bottom:10px" id="habitlisttool">
		<a href="#"  class="easyui-linkbutton" data-options="iconCls:'icon-add', plain:true "  onclick="javascript:$('#habitlist').edatagrid('addRow')">新增</a>
		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save', plain:true "  onclick="javascript:$('#habitlist').edatagrid('saveRow')">保存</a>
		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-redo', plain:true "  onclick="javascript:$('#habitlist').edatagrid('cancelRow')">取消</a>
	</div>
<table id="habitlist"></table>


	<input type="text" id="inputhabituser" value=<?php echo$_SESSION['admin'] ?> style="display: none;">

	


<!--htmlbody代码部分-->
<script type="text/javascript" src="js/jquery.edatagrid.js"></script>

<script>

$(function(){


				
//定义datagrid属性。

	$('#habitlist').edatagrid({    
	    url:'body/habitlist/habitlistload.php',  
	   	saveUrl: 'body/habitlist/habitlistsave.php',    
    	updateUrl:'body/habitlist/habitlistupdate.php',  
    	// destroyUrl:'body/habitlist/habitlistdelete.php',
	    width:800,
	    // saveUrl: ...,    
    	// updateUrl:'body/myhabit/updatedates.php', 
    	// destroyUrl:
	    title:'习惯列表',
	    columns:[[
	    	{
				field:'status',
				title:'状态',
				width:80,
				halign:'center',//标题居中，内容不居中
				editor:{
					type:'combobox',   //text,textarea,checkbox,numberbox,validatebox,datebox,combobox,combotree.
					options:{
						valueField : 'id',
						textField : 'status',
						panelHeight:100,
						editable:false,
						data : [
							{
								"id" : "运行",
								"status" : "运行",
							},
							{
								"id" : "关闭",
								"status" : "关闭",
							},
							{
								"id" : "暂停",
								"status" : "暂停",
							}
						]
					},
				},

			},{
				field:'habitcontent',
				title:'习惯内容',
				width:500,
				halign:'center',//标题居中，内容不居中
				editor:"text",

			},{
				field:'start_time',
				title:'开始时间',
				width:150,
				halign:'center',//标题居中，内容不居中
				editor:"datetimebox",

			},{
				field:'username',
				title:'用户',
				width:10,
				halign:'center',//标题居中，内容不居中
				hidden:true,
			}
	    ]],
	   	queryParams:{
			username :$('#inputhabituser').val(),
		},


		// 样式设置
		nowrap:true,  //true单行，false多行。
		fitColums:true,// 当出现滚动条时，自适应，去掉滚动条。
		rownumbers:true,//显示行号，
		singleSelect:true,//设置为true只能选定一行。
		// 工具栏
		 toolbar:'#habitlisttool',
		// onDestroy: function(){
		//  	alert('no');
		//  },

	});  


	


});	






</script>







