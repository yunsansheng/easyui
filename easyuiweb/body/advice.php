<?php 
	session_start();
 ?>

 <table id="box"></table>

 <div id="tb" style="padding: 5px;">

	 <div>
	 	<input type="text" class="textbox" id="inputadvice">
	 	<input type="text" id="inputuser" value=<?php echo$_SESSION['admin'] ?> style="display: none;">
	 	<a href="#" class="easyui-linkbutton textbox" iconCls="icon-save" onclick="obj.addadvice();">保存建议</a>
	 </div>

 	<div>
 		
<?php
	if($_SESSION['admin']=="One"){ //只有该用户有修改权限。
		echo '<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="obj.edit();">修改</a> <a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="obj.remove();">删除</a>';

	}

?>
 		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-save" style="display: none;" id='save' onclick="obj.save();">保存</a>
 		<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-redo"  style="display: none;" id='redo' onclick="obj.redo();">取消编辑</a>
 	</div>

 </div>





<style>
/*	.textbox{
		height: 26px;
		margin: 10px;
		padding: 0 2px;
		box-sizing:content-box;
	}*/


</style>

<script>
$(function(){

	//定义输入框的大小和图标等。
	$('#inputadvice').textbox({
		width:800,
		height:30,
		icons: [{
				iconCls:'icon-tip',
		}],
		iconAlign:'left',

	});

	// 自定义时间格式化方法
        Date.prototype.format = function (format) {

            var o = {

                "M+": this.getMonth() + 1, //month 

                "d+": this.getDate(), //day 

                "h+": this.getHours(), //hour 

                "m+": this.getMinutes(), //minute 

                "s+": this.getSeconds(), //second 

                "q+": Math.floor((this.getMonth() + 3) / 3), //quarter 

                "S": this.getMilliseconds() //millisecond 

            }

            if (/(y+)/.test(format)) {

                format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));

            }

            for (var k in o) {

                if (new RegExp("(" + k + ")").test(format)) {

                    format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));

                }

            }

            return format;

        }

  
        // 返回日期
		var now='';
		var nowtime='';
       	// 获取系统时间
        function systemTime()  
	    {  
		    now = new Date();
			nowtime = now.format("yyyy-MM-dd hh:mm:ss");
	    
	       // setTimeout("systemTime()",1000);  
	    }  






	//定义obj方法集
	obj={



		editRow:undefined,
		addadvice: function(){
				systemTime();
				$.ajax({
						type:'POST',
						url:'body/advice/adviceadd.php',
						data:{
							inputadvice:$('#inputadvice').val(),
							adviceman: $('#inputuser').val(),
							advicedate:nowtime,

						},
						beforeSend:function(){
							$('#box').datagrid('loading');
						},
						success: function(data){
							if(data){
								$('#box').datagrid('loaded');
								$('#box').datagrid('load');
								$.messager.show({
									title:'提示',
									msg:data+'条数据被新增成功',
								});
							}
						},
				});

			$('#inputadvice').textbox('clear');

		},
		//在首行前新增一行
		add:function(){
			/*//当前页结尾增加
			$('#box').datagrid('appendRow',{
				username:'bbs',
				password:'psd',
				date:'2014-11-12',
			});
			*/
			$('#save,#redo').show();
			if(this.editRow == undefined){ //false时才能添加
			//添加一行
				$('#box').datagrid('insertRow',{
					index: 0,
					row:{
						/*
						username:'bbs',
						password:'psd',
						date:'2014-11-12',
						*/

					}
				});
			}
		$('#box').datagrid('beginEdit',0);  //索引将第一行设置为可编辑状态
			this.editRow=0;
		},

		save:function(){
			// 将该行设置为结束编辑
			$('#box').datagrid('endEdit',this.editRow);

		},
		redo:function(){
			$('#save,#redo').hide();
			this.editRow=undefined;
			$('#box').datagrid('rejectChanges');
		},
		edit: function(){
			
			var rows =$('#box').datagrid('getSelections');
				if(rows.length ==1){
					var index= $('#box').datagrid('getRowIndex',rows[0]);
					if (this.editRow != undefined) {
						$('#box').datagrid('endEdit', this.editRow);
					}
				
					if (this.editRow == undefined) {
						$('#save,#redo').show();
						$('#box').datagrid('beginEdit', index);
						this.editRow = index;
						$('#box').datagrid('unselectRow',index);
					}
				}else{
					$.messaget.alert('警告','修改条数只能为1','warning')
				}
		},
		remove: function(){

			var  rows= $('#box').datagrid('getSelections');
			if(rows.length >0){
				$.messager.confirm('确定操作','确定删除？',function(flag){
					if(flag){
						var ids=[];
						for(var i=0; i<rows.length; i++){
							ids.push(rows[i].id)
						}
						//console.log(ids.join(','));
						$.ajax({
							type:'POST',
							url:'body/advice/delete.php',
							data:{
								ids:ids.join(','),
							},
							beforeSend:function(){
								$('#box').datagrid('loading');
							},
							success: function(data){
								if(data){
									$('#box').datagrid('loaded');
									$('#box').datagrid('load');
									$('#box').datagrid('unselectAll');
									$.messager.show({
										title:'提示',
										msg:data+'条数据被删除成功',
									});
								}
							},
						});
					}
				});
			}else{
				$.messager.alert('提示','请选择要删除的行','info');
			}
		},
	}

	//定义datagrid属性。
	$('#box').datagrid({
		url:'body/advice/adviceload.php',
		title:'系统建议',
		fixed:true,
		iconCls:'icon-tip',
		columns:[[{
				field:'advicecontent',
				title:'建议内容',
				width:600,
				halign:'center',//标题居中，内容不居中

			},{
				field:'adviceman',
				title:'建议人',
				width:100,
				halign:'center',//标题居中，内容不居中
			},{
				field:'advicedate',
				title:'建议时间',
				sortable:true,
				halign:'center',//标题居中，内容不居中
				width:200,
			},{
				field:'advicestatu',
				title:'采纳状态',
				width:100,
				halign:'center',//标题居中，内容不居中
				editor:{
					type:'combobox',   //text,textarea,checkbox,numberbox,validatebox,datebox,combobox,combotree.
					options:{
						valueField : 'id',
						textField : 'status',
						panelHeight:100,
						data : [
							{
								"id" : "已采纳",
								"status" : "已采纳",
							},
							{
								"id" : "不采纳",
								"status" : "不采纳",
							},
							{
								"id" : "保留建议",
								"status" : "保留建议",
							}
						]
					},
				},
			},{
				field:'advicebb',
				title:'部署版本',
				width:100,
				halign:'center',//标题居中，内容不居中
				editor:{
					type:'text',   //text,textarea,checkbox,numberbox,validatebox,datebox,combobox,combotree.
					
				},
			}
		]],

		pagination:true,
		pageSize:10,
		pageNmeber:1,
		pagePostion:'buttom',//工具栏位置
		sortName:'advicedate',
		sortOrder:'Desc',
		remoteSort:true,//通过服务器进行排序，默认true,否则只能排序当前数据
		method:'post',
		// 发送额外的数据
		queryParams:{
			id:1,
		},

		// 样式设置
		//striped:true,
		nowrap:true,  //true单行，false多行。
		//fitColums:true,// 当出现滚动条时，自适应，去掉滚动条。
		//fitColums:false,//用于冻结功能模拟设置。
		//loadMsg:'努力获取数据中',
		rownumbers:true,//显示行号，
		singleSelect:true,//设置为true只能选定一行。
		//showHeader:false,显示和隐藏标题
		showfooter:false,//默认不显示行尾。
		//scrollbarSize:18,//scrollbar height or width 不要改
		/*
		rowStyler: function(index,row){
			//console.log(row);
			if(row.username =='one'){
				return 'background-color:blue';
				//这里返回的也可以是CSS的class名称
			}
		},
		*/

		// 工具栏
		toolbar:'#tb',



		//双击打开编辑。
		// onDblClickRow : function (rowIndex, rowData) {
		
		// 	if (obj.editRow != undefined) {
		// 		$('#box').datagrid('endEdit', obj.editRow);
		// 	}
		
		// 	if (obj.editRow == undefined) {
		// 		$('#save,#redo').show();
		// 		$('#box').datagrid('beginEdit', rowIndex);
		// 		obj.editRow = rowIndex;
		// 	}
			
		// },
		onAfterEdit : function (rowIndex, rowData, changes) {
			$('#save,#redo').hide();
			var inserted=$('#box').datagrid('getChanges','inserted');
			var updated=$('#box').datagrid('getChanges','updated');
			// 新增用户
			if(inserted.length > 0){
				$.ajax({
						type:'POST',
						url:'add.php',
						data:{
							row: inserted, 
						},
						beforeSend:function(){
							$('#box').datagrid('loading');
						},
						success: function(data){
							if(data){
								$('#box').datagrid('loaded');
								$('#box').datagrid('load');
								$('#box').datagrid('unselectAll');
								$.messager.show({
									title:'提示',
									msg:data+'条数据被新增成功',
								});
								obj.editRow = undefined;
							}
						},
				});

			}
			// 修改用户
			if(updated.length > 0){
				$.ajax({
					type:'POST',
					url:'body/advice/update.php',
					data:{
						row: updated, 
					},
					beforeSend:function(){
						$('#box').datagrid('loading');
					},
					success: function(data){
						if(data){
							$('#box').datagrid('loaded');
							$('#box').datagrid('load');
							$('#box').datagrid('unselectAll');
							$.messager.show({
								title:'提示',
								msg:data+'条数据被修改成功',
							});
							obj.editRow = undefined;
						}
					},
				});
			}

			
			//console.log(rowData);

		},

		// onHeaderContextMenu :function(e,filed){

		// },
		// 右键菜单
		// onRowContextMenu: function(e,rowIndex,rowData){
		// 	e.preventDefault();
		// 	$('#menu').menu('show',{
		// 		left:e.pageX,
		// 		top:e.pageY,
		// 	});
		// },
		// 其他事件
		/*
		onClickRow: function(){
			alert('单击一行时触发');
		},
		onClickCell :function(rowIndex,field,value){
			alert('单机一个单元格时触发');
		},


		onUnselect:function(rowIndex,rowData){
			alert('取消选定一行时触发');
		},

		onCheck : function(){
			alert('勾选时触发（一行）')
		},
		
		onCancelEdit : function(){
			alert('取消编辑触发');
		},
		onSortColumn: function(sort,order){
			alert('排序时触发');
		},
		*/



	});
	
	// $(document).click(function(){
	// 	$('#box').datagrid('hideColumn', 'id');
	// });



});	



</script>

