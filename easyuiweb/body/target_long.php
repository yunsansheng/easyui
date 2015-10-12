

<script>
$(function(){

//扩展 dateTimeBox
$.extend($.fn.datagrid.defaults.editors, {
	datetimebox : {
		init: function(container, options){
			var input = $('<input type="text">').appendTo(container);
			options.editable = false;
			input.datetimebox(options);
			return input;
		},
		getValue: function(target){
			return $(target).datetimebox('getValue');
		},
		setValue: function(target, value){
			$(target).datetimebox('setValue', value);
		},
		resize: function(target, width){
			$(target).datetimebox('resize', width);
		},
		destroy : function (target) {
			$(target).datetimebox('destroy');
		},
	}
});


	// 定义obj
	// {
		// 主要的方法有:
		// editrow :   定义editrow为undefined.
		// add:    function
		// save:   function
		// redo:   function
		// eidt:   function
		// remove：function
	// }
	obj={

		editRow:undefined,


		// load方法，用于加载第一页，或者传参进行筛选。
		// search:function(){
		// 	$('#target_box').datagrid('load',{
		// 		username:$.trim($('input[name="username"]').val()),
		// 		date_from:$.trim($('input[name="date_from"]').val()),
		// 		date_to:$.trim($('input[name="date_to"]').val()),
		// 	});
		// },

		// 新增的方法
		// 第一种是通过appendRow在末尾添加，第二种是通过insertROW在首行添加。
		add:function(){
			/*//当前页结尾增加
			appendRow   row
			$('#target_box').datagrid('appendRow',{
				username:'bbs',
				password:'psd',
				date:'2014-11-12',
			});
			*/
			// 在编辑时，显示出保存和撤销按钮
			$('#save,#redo').show();
			if(this.editRow == undefined){ //false时才能添加
			//添加一行
			//insertRow param  index  和 row
				$('#target_box').datagrid('insertRow',{
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
		// 将第一行设置为可编辑状态
		//add插入后开启编辑状态  只需传参index  
			$('#target_box').datagrid('beginEdit',0);  //索引
			// 开启编辑状态后，将editRow设置为0，这样既不是undefined就不能够进行add操作。插入新行。
			this.editRow=0;  //this 代表的是obj，add后，开启编辑并给个0

		},

		// 保存方法
		save:function(){
			// 将第一行设置为结束编辑
			$('#target_box').datagrid('endEdit',this.editRow);

		},
		redo:function(){
			$('#save,#redo').hide();
			this.editRow=undefined;
			$('#target_box').datagrid('rejectChanges');
			// rejectChages回滚所有从创建或者上一次调用acceptChanges函数后更改的数据。
		},

		// 编辑方法
		edit: function(){
			// 获取目前选择的数据，返回的是一个数组
			var rows =$('#target_box').datagrid('getSelections');
				if(rows.length ==1){
					// 获取当前的数组
					var index= $('#target_box').datagrid('getRowIndex',rows[0]);
					// 如果不是undefined，证明正在编辑中，因此editrow是0
					// 如果是0，那么就是第一行可以编辑
					if (this.editRow != undefined) {
						$('#target_box').datagrid('endEdit', this.editRow);
					}
					// 如果不在编辑状态，显示按钮，并赋值index.
					if (this.editRow == undefined) {
						$('#save,#redo').show();
						$('#target_box').datagrid('beginEdit', index);
						// 将当前的editrow赋值给index
						this.editRow = index;
						// 取消选择这一行，防止index不变。
						$('#target_box').datagrid('unselectRow',index);
					}
				}else{
					$.messaget.alert('警告','修改条数只能为1','warning')
				}
		},

		// 移除方法
		remove: function(){
			// 获取选择的rows，获得的是对象
			var  rows= $('#target_box').datagrid('getSelections');
			// 如果大于0，提示
			if(rows.length >0){
				$.messager.confirm('确定操作','确定删除？',function(flag){
					if(flag){
						// 创建一个ids空数组，将这些id数据保存在数组中。
						var ids=[];
						for(var i=0; i<rows.length; i++){
							ids.push(rows[i].id)  
						}
						//console.log(ids.join(','));  //在ids 中通过，分割 因为要用in的方法批量删除
						//
						// 通过ajax方法，将这些数据提交到php
						$.ajax({
							type:'POST',
							url:'body/target/target_delete.php',
							data:{
								ids:ids.join(','),
							},
							beforeSend:function(){
								$('#target_box').datagrid('loading');
							},
							success: function(data){
								if(data){
									// 成功后重载数据，并取消所有选择。
									$('#target_box').datagrid('loaded');
									$('#target_box').datagrid('load');
									$('#target_box').datagrid('unselectAll');
									// $.messager.show({
									// 	title:'提示',
									// 	msg:data+'条数据被删除成功',
									// });
								}
							},
						});
					}
				});
			}else{
				// 否则提示要选择的行
				$.messager.alert('提示','请选择要删除的行','info');
			}
		},
	}


	$('#target_box').datagrid({
		//width:600,
		url:'body/target/target_load.php',
		//url:'content.json',
		//title:'用户列表',
		//iconCls:'icon-search',
		/*
		frozenColumns : [[
		{
				field:'id',
				title:'编号',
				sortable:true,
				width:100,
				checkbox:'true',
			},{
				field:'username',
				title:'账号',
				width:200,
				sortable:true,
				editor:{
					type:'validatebox',   //text,textarea,checkbox,numberbox,validatebox,datebox,combobox,combotree.
					options:{
						required:true,
					},
				},
				//fixed:true,//阻止自适应
				// 列样式
				//align:'center',标题和内容都居中
				// halign:'center',标题居中，内容不居中
				// resizable:false,//不能调整改列大小
				// hidden:true,隐藏
				// formatter:function(value,row,index){
				// 	return '['+value+']';
				// },
				// styler:function(value,row,index){ //单元格样式
				// 	if(value=='one'){
				// 		return 'background-color:orange';
				// 	}
				// },

			   },
		]],
		*/
		columns:[[{
				field:'username',
				title:'账号',
				width:100,
				sortable:true,
				editor:{
					type:'text'   //text,textarea,checkbox,numberbox,validatebox,datebox,combobox,combotree.
				},
				align:'center',
				hidden:true,
				height:80,
				//fixed:true,//阻止自适应
				// 列样式
				//align:'center',标题和内容都居中
				// halign:'center',标题居中，内容不居中
				// resizable:false,//不能调整改列大小
				// hidden:true,隐藏
				// formatter:function(value,row,index){
				// 	return '['+value+']';
				// },
				// styler:function(value,row,index){ //单元格样式
				// 	if(value=='one'){
				// 		return 'background-color:orange';
				// 	}
				// },

			   },{
				field:'start_year',
				title:'开始年',
				sortable:true,
				width:80,
				align:'center',
				editor:{
					type:'text'
					},
				},{
				field:'end_year',
				title:'结束年',
				sortable:true,
				width:80,
				align:'center',
				editor:{
					type:'text'
					},
				},{
				field:'target_life',
				title:'人生目标',
				width:280,
				halign:'center',
				editor:{
					type:'text'
					},
				},{
				field:'target_work',
				title:'工作目标',
				width:280,
				halign:'center',
				editor:{
					type:'text'
					},
				},{
				field:'target_live',
				title:'生活目标',
				width:280,
				halign:'center',
				editor:{
					type:'text'
					},
				},{
				field:'target_note',
				title:'其他备注',
				width:150,
				halign:'center',
				editor:{
					type:'text'
					},
				},
		]],
		// data:[//会被远程加载的数据替代掉
		// {
		// 	username:'手工用户',
		// 	password:'手工邮件',
		// 	data:'2014-10-11',
		// },
		//],
		//pagination:true,
		//pageSize:5,
		//pageList:[5,10,15],
		//pageNmeber:1,
		//pagePostion:'buttom',//工具栏位置
		// sortName:'',
		// sortOrder:'Asc',
		remoteSort:true,//通过服务器进行排序，默认true,否则只能排序当前数据
		//multiSort:'true',//是否可以同时排序
		 method:'post',
		// 发送额外的数据
		queryParams:{
			id:1,
		},

		// 样式设置
		//striped:true,
		nowrap:false,  //true单行，false多行。
		//fitColums:true,// 当出现滚动条时，自适应，去掉滚动条。
		//fitColums:false,//用于冻结功能模拟设置。
		//loadMsg:'努力获取数据中',
		rownumbers:true,//显示行号，
		singleSelect:true,//设置为true只能选定一行。
		//showHeader:false,显示和隐藏标题
		// showfooter:false,//默认不显示行尾。
		// scrollbarSize:18,//scrollbar height or width 不要改
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
		toolbar:'#target_tb',

		onDblClickRow : function (rowIndex, rowData) {
		
			if (obj.editRow != undefined) {
				$('#target_box').datagrid('endEdit', obj.editRow);
			}
		
			if (obj.editRow == undefined) {
				$('#save,#redo').show();
				$('#target_box').datagrid('beginEdit', rowIndex);
				obj.editRow = rowIndex;
			}
			
		},
		// 编辑完成后
		onAfterEdit : function (rowIndex, rowData, changes) {
			$('#save,#redo').hide();
			// getchanges 有inserted,deleted,updated三种
			// 将新增的数据赋值给inserted
			var inserted=$('#target_box').datagrid('getChanges','inserted');
			// 将updated的数据赋值给updated
			var updated=$('#target_box').datagrid('getChanges','updated');
			// 如果新增的行数大于0
			if(inserted.length > 0){
				$.ajax({
						type:'POST',
						url:'body/target/target_add.php',
						data:{
							row: inserted, 
						},
						beforeSend:function(){
							$('#target_box').datagrid('loading');
						},
						success: function(data){
							if(data){
								$('#target_box').datagrid('loaded');
								$('#target_box').datagrid('load');
								$('#target_box').datagrid('unselectAll');
								// $.messager.show({
								// 	title:'提示',
								// 	msg:data+'条数据被新增成功',
								// });
								obj.editRow = undefined;
							}
						},
				});
			}
			//如果修改的行数大于0
			if(updated.length > 0){
				$.ajax({
					type:'POST',
					url:'body/target/target_update.php',
					data:{
						row: updated, 
					},
					beforeSend:function(){
						$('#target_box').datagrid('loading');
					},
					success: function(data){
						if(data){
							$('#target_box').datagrid('loaded');
							$('#target_box').datagrid('load');
							$('#target_box').datagrid('unselectAll');
							// $.messager.show({
							// 	title:'提示',
							// 	msg:data+'条数据被修改成功',
							// });
							obj.editRow = undefined;
						}
					},
				});
			}

			
			//console.log(rowData);

		},

		// onHeaderContextMenu :function(e,filed){

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
	

 		

});	


	// 剩余方法
function abc() {
	//$('#box').datagrid('deleteRow', 0);
	//$('#box').datagrid('checkAll');
	//$('#box').datagrid('highlightRow', 0);
	$('#target_box').datagrid('mergeCells', {
		index : 0,
		field : 'user',
		//rowspan : 5,
		//colspan : 3,
	});
}
</script>



 <table id="target_box"></table>

 <div id="target_tb" style="padding: 5px;">
 		<div>
 			<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-add" onclick="obj.add();">添加</a>
 			<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-edit" onclick="obj.edit();">修改</a>
 			<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-remove" onclick="obj.remove();">删除</a>
 			<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-save" style="display: none;" id='save' onclick="obj.save();">保存</a>
 			<a href="#" class="easyui-linkbutton" plain="true" iconCls="icon-redo"  style="display: none;" id='redo' onclick="obj.redo();">取消编辑</a>
 		</div>

 </div>


