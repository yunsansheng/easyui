

	<style>
		*{
			font-size:12px;
		}
		body {
		    font-family:verdana,helvetica,arial,sans-serif;
		    padding:20px;
		    font-size:12px;
		    margin:0;
		}
		
	</style>

	<table id="dg_jita">
		
	</table>

	<div id="tb_jita">

		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg_jita').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg_jita').edatagrid('destroyRow')">Delete</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg_jita').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg_jita').edatagrid('cancelRow')">Cancel</a>
	</div>
	

	<script type="text/javascript">
		$(function(){
			$('#dg_jita').edatagrid({
				url: 'body/jita/get_song.php',
				saveUrl: 'body/jita/save_song.php',
				updateUrl: 'body/jita/update_song.php',
				destroyUrl: 'body/jita/destroy_song.php',
				title:'Mysong',
				columns:[[{
					field:'id',
					title:'id',
					width:10,
					hidden:true,
				},{
					field:'status',
					title:'状态',
					width:60,
					editor:{
						type:'combobox',
						options:{
							valueField : 'id',
							textField : 'text',
							panelHeight:100,
							data : [
								{
									"id" : "进行中",
									"text" : "进行中",
								},
								{
									"id" : "计划中",
									"text" : "计划中",
								},
								{
									"id" : "已完成",
									"text" : "已完成",
								},
								{
									"id" : "待定中",
									"text" : "待定中",
								}
							]
						},
					},
				},{
					field:'songname',
					title:'曲目',
					width:200,
					editor:{type:'text'},
				},{
					field:'type',
					title:'类型',
					width:60,
					editor:{
						type:'combobox',
						options:{
							valueField : 'id',
							textField : 'text',
							panelHeight:80,
							data : [
								{
									"id" : "弹唱",
									"text" : "弹唱",
								},
								{
									"id" : "指弹",
									"text" : "指弹",
								},
								{
									"id" : "其他",
									"text" : "其他",
								}
							]
						},
					},
				},{
					field:'sortid',
					title:'排序号',
					width:40,
					editor:{type:'text'},
				},{
					field:'input_time',
					title:'输入时间',
					width:60,
					editor:{type:'datebox'},
				},{
					field:'start_time',
					title:'开始时间',
					width:60,
					editor:{type:'datebox'},
				},{
					field:'complete_time',
					title:'完成时间',
					width:60,
					editor:{type:'datebox'},
				},{
					field:'review_time',
					title:'回顾时间',
					width:60,
					editor:{type:'datebox'},
				},{
					field:'overday',
					title:'超期天数',
					width:40,
				},{
					field:'note',
					title:'备注',
					width:160,
					editor:{type:'text'},
				},
				]],
				toolbar:'#tb_jita',
				idField:'id',
				fitColumns:true,
				rownumbers:true,
				singleSelect:true,

			});
		});
	</script>
