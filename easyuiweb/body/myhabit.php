
<?php 
	session_start();

 ?>

<!--htmlbody代码部分-->


<!-- <a href="#"  class="easyui-linkbutton" data-options="iconCls:'icon-add', plain:true "  onclick="javascript:$('#habitbox').edatagrid('addRow')">新增</a> -->
		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save', plain:true "  onclick="javascript:$('#habitbox').edatagrid('saveRow')">保存</a>
		
		<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-redo', plain:true "  onclick="javascript:$('#habitbox').edatagrid('cancelRow')">取消</a>
<table id="habitbox"></table>

	 <div id="habittb" style="padding: 5px;">
		<input id="year" name="year" value="">   
		<input id="month" name="month" value=""> 
		<!-- <input id="statuselect" name="statuselect" value="" style="display: none;">  -->
		<input type="text" id="inputhabituser" value=<?php echo$_SESSION['admin'] ?> style="display: none;">
		<!-- <a href="#" class="easyui-linkbutton textbox" iconCls="icon-edit" id="edittable">启用编辑</a> -->
		

<!-- 	日期选择和过滤，
		状态字段，
		题头状态筛选。
		新增,
		删除。
		正在编辑时退出编辑
		 -->

	
 </div>
<!--htmlbody代码部分-->
<script type="text/javascript" src="js/jquery.edatagrid.js"></script>
<script>







$(function(){
		objh={

		}


				var status='运行';

				$('#year').combobox({       
				    valueField:'id',    
				    textField:'year',
					//editable:false,
					panelHeight:75,
					width: 100,
					data : [
							{
								"id" : "2015",
								"year" : "2015",
							},
							{
								"id" : "2016",
								"year" : "2016",
							},
							{
								"id" : "2017",
								"year" : "2017",
							}
						],
					onChange:function(oldValue,newValue){
						//重新计算列天数
						//改变数组
						//重新载入数据
						if(newValue !==''){
							// alert('change');
							year=$('#year').combobox('getValue');
							dates = testGetLastDateOfMonth(year, month); 
							//alert(dates);
							//console.log($('#habitbox').edatagrid('options').queryParams.year);
							//year=$('#year').combobox('getValue');
							$('#habitbox').edatagrid('options').queryParams.year=year;
							
							
						}
						
					},
					onHidePanel:function(){
								$('#habitbox').edatagrid('loaded');
								$('#habitbox').edatagrid('load');
							},
				}); 
				$('#month').combobox({       
				    valueField:'id',    
				    textField:'month',
					//editable:false,
					width:100,
					data : [
							{
								"id" : "1",
								"month" : "1",
							},
							{
								"id" : "2",
								"month" : "2",
							},
							{
								"id" : "3",
								"month" : "3",
							},{
								"id" : "4",
								"month" : "4",
							},{
								"id" : "5",
								"month" : "5",
							},{
								"id" : "6",
								"month" : "6",
							},{
								"id" : "7",
								"month" : "7",
							},{
								"id" : "8",
								"month" : "8",
							},{
								"id" : "9",
								"month" : "9",
							},{
								"id" : "10",
								"month" : "10",
							},{
								"id" : "11",
								"month" : "11",
							},{
								"id" : "12",
								"month" : "12",
							}
						],
					onChange:function(oldValue,newValue){
						//重新计算列天数
						//改变数组
						//重新载入数据
						if(newValue !==''){
							month=$('#month').combobox('getValue');
							dates = testGetLastDateOfMonth(year, month); 
							switch(dates)
							{

								case 31:
								$('#habitbox').edatagrid('showColumn','date31');
								$('#habitbox').edatagrid('showColumn','date30');
								$('#habitbox').edatagrid('showColumn','date29');

								break;

								case 30:
								$('#habitbox').edatagrid('hideColumn','date31');
								$('#habitbox').edatagrid('showColumn','date30');
								$('#habitbox').edatagrid('showColumn','date29');
								break;


								case 29: 
								$('#habitbox').edatagrid('hideColumn','date31');
								$('#habitbox').edatagrid('hideColumn','date30');
								$('#habitbox').edatagrid('showColumn','date29');

								break;

								case 28: 
								$('#habitbox').edatagrid('hideColumn','date31'); 
								$('#habitbox').edatagrid('hideColumn','date30');
								$('#habitbox').edatagrid('hideColumn','date29');
								break;

							}

							$('#habitbox').edatagrid('options').queryParams.month=month;

							
						}
					},  
				onHidePanel:function(){
								$('#habitbox').edatagrid('loaded');
								$('#habitbox').edatagrid('load');
							}, 
				}); 


				// $('#statuselect').combobox({       
				//     valueField:'id',    
				//     textField:'status',
				// 	//editable:false,
				// 	panelHeight:75,
				// 	width: 80,
				// 	value: '运行',
				// 	data : [
				// 			{
				// 				"id" : "运行",
				// 				"status" : "运行",
				// 			},
				// 			{
				// 				"id" : "关闭",
				// 				"status" : "关闭",
				// 			},
				// 			{
				// 				"id" : "暂停",
				// 				"status" : "暂停",
				// 			}
				// 	],
				// 	onChange:function(oldValue,newValue){
				// 		//重新计算列天数
				// 		//改变数组
				// 		//重新载入数据
				// 		if(newValue !==''){
				// 	 status=$('#statuselect').combobox('getValue');
				// 	 $('#habitbox').edatagrid('options').queryParams.status=status;

				// 		}
				// 	},
				// onHidePanel:function(){
				// 				$('#habitbox').edatagrid('loaded');
				// 				$('#habitbox').edatagrid('load');
				// 			}, 

				// }); 



	// 时间计算函数库
		function getLastDateOfMonth(year, month) {  
			return new Date(new Date(year, month , 1).getTime() - 1000 * 60 * 60 * 24);  
		}  
	
		//对最后一天转化成date
		function testGetLastDateOfMonth(year, month) {  
				return getLastDateOfMonth(year, month).getDate();  
		}   




	//获取当前年和月
		var date=new Date();
		var defaultyear = date.getFullYear();
		var defaultmonth= date.getMonth()+1

		$('#year').combobox('setValue', defaultyear);
		$('#month').combobox('setValue', defaultmonth);

		//取到当前的年和月 进行最后一天的计算.
		var year=$('#year').combobox('getValue');
		var month=$('#month').combobox('getValue');

		//赋值给变量
		var dates = testGetLastDateOfMonth(year, month);  





// 时间一共29 28 30 31 四种

var dateArray='';

switch(dates)
{
case 28: dateArray =[[{field : 'date1',title: 1,width :25,align:'center',editor:"text"},{field : 'date2',title: 2,width :25,align:'center',editor:"text"},{field : 'date3' ,title: 3,width :25,align:'center',editor:"text"},{field : 'date4' ,title: 4,width :25,align:'center',editor:"text"},{field : 'date5' ,title: 5,width :25,align:'center',editor:"text"},{field : 'date6' ,title: 6,width :25,align:'center',editor:"text"},{field : 'date7' ,title: 7,width :25,align:'center',editor:"text"},{field : 'date8' ,title: 8,width :25,align:'center',editor:"text"},{field : 'date9' ,title: 9,width :25,align:'center',editor:"text"},{field : 'date10' ,title: 10,width :25,align:'center',editor:"text"},{field : 'date11' ,title: 11,width :25,align:'center',editor:"text"},{field : 'date12' ,title: 12,width :25,align:'center',editor:"text"},{field : 'date13' ,title: 13,width :25,align:'center',editor:"text"},{field : 'date14' ,title: 14,width :25,align:'center',editor:"text"},{field : 'date15' ,title: 15,width :25,align:'center',editor:"text"},{field : 'date16' ,title: 16,width :25,align:'center',editor:"text"},{field : 'date17' ,title: 17,width :25,align:'center',editor:"text"},{field : 'date18' ,title: 18,width :25,align:'center',editor:"text"},{field : 'date19' ,title: 19,width :25,align:'center',editor:"text"},{field : 'date20' ,title: 20,width :25,align:'center',editor:"text"},{field : 'date21' ,title: 21,width :25,align:'center',editor:"text"},{field : 'date22' ,title: 22,width :25,align:'center',editor:"text"},{field : 'date23' ,title: 23,width :25,align:'center',editor:"text"},{field : 'date24' ,title: 24,width :25,align:'center',editor:"text"},{field : 'date25' ,title: 25,width :25,align:'center',editor:"text"},{field : 'date26' ,title: 26,width :25,align:'center',editor:"text"},{field : 'date27' ,title: 27,width :25,align:'center',editor:"text"},{field : 'date28' ,title: 28,width :25,align:'center',editor:"text"}]];
  break;

case 29: dateArray =[[{field : 'date1',title: 1,width :25,align:'center',editor:"text"},{field : 'date2',title: 2,width :25,align:'center',editor:"text"},{field : 'date3' ,title: 3,width :25,align:'center',editor:"text"},{field : 'date4' ,title: 4,width :25,align:'center',editor:"text"},{field : 'date5' ,title: 5,width :25,align:'center',editor:"text"},{field : 'date6' ,title: 6,width :25,align:'center',editor:"text"},{field : 'date7' ,title: 7,width :25,align:'center',editor:"text"},{field : 'date8' ,title: 8,width :25,align:'center',editor:"text"},{field : 'date9' ,title: 9,width :25,align:'center',editor:"text"},{field : 'date10' ,title: 10,width :25,align:'center',editor:"text"},{field : 'date11' ,title: 11,width :25,align:'center',editor:"text"},{field : 'date12' ,title: 12,width :25,align:'center',editor:"text"},{field : 'date13' ,title: 13,width :25,align:'center',editor:"text"},{field : 'date14' ,title: 14,width :25,align:'center',editor:"text"},{field : 'date15' ,title: 15,width :25,align:'center',editor:"text"},{field : 'date16' ,title: 16,width :25,align:'center',editor:"text"},{field : 'date17' ,title: 17,width :25,align:'center',editor:"text"},{field : 'date18' ,title: 18,width :25,align:'center',editor:"text"},{field : 'date19' ,title: 19,width :25,align:'center',editor:"text"},{field : 'date20' ,title: 20,width :25,align:'center',editor:"text"},{field : 'date21' ,title: 21,width :25,align:'center',editor:"text"},{field : 'date22' ,title: 22,width :25,align:'center',editor:"text"},{field : 'date23' ,title: 23,width :25,align:'center',editor:"text"},{field : 'date24' ,title: 24,width :25,align:'center',editor:"text"},{field : 'date25' ,title: 25,width :25,align:'center',editor:"text"},{field : 'date26' ,title: 26,width :25,align:'center',editor:"text"},{field : 'date27' ,title: 27,width :25,align:'center',editor:"text"},{field : 'date28' ,title: 28,width :25,align:'center',editor:"text"},{field : 'date29' ,title: 29,width :25,align:'center',editor:"text"}]];
  break;

 case 30: dateArray =[[{field : 'date1',title: 1,width :25,align:'center',editor:"text"},{field : 'date2',title: 2,width :25,align:'center',editor:"text"},{field : 'date3' ,title: 3,width :25,align:'center',editor:"text"},{field : 'date4' ,title: 4,width :25,align:'center',editor:"text"},{field : 'date5' ,title: 5,width :25,align:'center',editor:"text"},{field : 'date6' ,title: 6,width :25,align:'center',editor:"text"},{field : 'date7' ,title: 7,width :25,align:'center',editor:"text"},{field : 'date8' ,title: 8,width :25,align:'center',editor:"text"},{field : 'date9' ,title: 9,width :25,align:'center',editor:"text"},{field : 'date10' ,title: 10,width :25,align:'center',editor:"text"},{field : 'date11' ,title: 11,width :25,align:'center',editor:"text"},{field : 'date12' ,title: 12,width :25,align:'center',editor:"text"},{field : 'date13' ,title: 13,width :25,align:'center',editor:"text"},{field : 'date14' ,title: 14,width :25,align:'center',editor:"text"},{field : 'date15' ,title: 15,width :25,align:'center',editor:"text"},{field : 'date16' ,title: 16,width :25,align:'center',editor:"text"},{field : 'date17' ,title: 17,width :25,align:'center',editor:"text"},{field : 'date18' ,title: 18,width :25,align:'center',editor:"text"},{field : 'date19' ,title: 19,width :25,align:'center',editor:"text"},{field : 'date20' ,title: 20,width :25,align:'center',editor:"text"},{field : 'date21' ,title: 21,width :25,align:'center',editor:"text"},{field : 'date22' ,title: 22,width :25,align:'center',editor:"text"},{field : 'date23' ,title: 23,width :25,align:'center',editor:"text"},{field : 'date24' ,title: 24,width :25,align:'center',editor:"text"},{field : 'date25' ,title: 25,width :25,align:'center',editor:"text"},{field : 'date26' ,title: 26,width :25,align:'center',editor:"text"},{field : 'date27' ,title: 27,width :25,align:'center',editor:"text"},{field : 'date28' ,title: 28,width :25,align:'center',editor:"text"},{field : 'date29' ,title: 29,width :25,align:'center',editor:"text"},{field : 'date30' ,title: 30,width :25,align:'center',editor:"text"}]];

  break;

case 31: dateArray =[[{field : 'date1',title: 1,width :25,align:'center',editor:"text"},{field : 'date2',title: 2,width :25,align:'center',editor:"text"},{field : 'date3' ,title: 3,width :25,align:'center',editor:"text"},{field : 'date4' ,title: 4,width :25,align:'center',editor:"text"},{field : 'date5' ,title: 5,width :25,align:'center',editor:"text"},{field : 'date6' ,title: 6,width :25,align:'center',editor:"text"},{field : 'date7' ,title: 7,width :25,align:'center',editor:"text"},{field : 'date8' ,title: 8,width :25,align:'center',editor:"text"},{field : 'date9' ,title: 9,width :25,align:'center',editor:"text"},{field : 'date10' ,title: 10,width :25,align:'center',editor:"text"},{field : 'date11' ,title: 11,width :25,align:'center',editor:"text"},{field : 'date12' ,title: 12,width :25,align:'center',editor:"text"},{field : 'date13' ,title: 13,width :25,align:'center',editor:"text"},{field : 'date14' ,title: 14,width :25,align:'center',editor:"text"},{field : 'date15' ,title: 15,width :25,align:'center',editor:"text"},{field : 'date16' ,title: 16,width :25,align:'center',editor:"text"},{field : 'date17' ,title: 17,width :25,align:'center',editor:"text"},{field : 'date18' ,title: 18,width :25,align:'center',editor:"text"},{field : 'date19' ,title: 19,width :25,align:'center',editor:"text"},{field : 'date20' ,title: 20,width :25,align:'center',editor:"text"},{field : 'date21' ,title: 21,width :25,align:'center',editor:"text"},{field : 'date22' ,title: 22,width :25,align:'center',editor:"text"},{field : 'date23' ,title: 23,width :25,align:'center',editor:"text"},{field : 'date24' ,title: 24,width :25,align:'center',editor:"text"},{field : 'date25' ,title: 25,width :25,align:'center',editor:"text"},{field : 'date26' ,title: 26,width :25,align:'center',editor:"text"},{field : 'date27' ,title: 27,width :25,align:'center',editor:"text"},{field : 'date28' ,title: 28,width :25,align:'center',editor:"text"},{field : 'date29' ,title: 29,width :25,align:'center',editor:"text"},{field : 'date30' ,title: 30,width :25,align:'center',editor:"text"},{field : 'date31' ,title: 31,width :25,align:'center',editor:"text"}]];
  break;

}

// 定义combox属性



//定义datagrid属性。

	$('#habitbox').edatagrid({    
	    url:'body/myhabit/myhabitload.php',  
	    // saveUrl: 'body/myhabit/myhabitsave.php',     
    	updateUrl:'body/myhabit/updatedates.php', 
    	// destroyUrl:
	    title:'习惯记录',
	    // iconCls:'icon-tip',
	    frozenColumns:[[
	    	{
				field:'status',
				title:'状态',
				width:80,
				halign:'center',//标题居中，内容不居中

			},{
				field:'habitcontent',
				title:'习惯内容',
				width:300,
				halign:'center',//标题居中，内容不居中
				//editor:"text",

			},{
				field:'start_time',
				title:'开始时间',
				width:150,
				halign:'center',//标题居中，内容不居中
				//editor:"text",

			},{
				field:'username',
				title:'用户',
				width:50,
				halign:'center',//标题居中，内容不居中
			    // hidden:true,
			},{
				field:'year',
				title:'年',
				width:30,
				halign:'center',//标题居中，内容不居中
				hidden:true,
				editor:"text",
			},{
				field:'month',
				title:'月',
				width:30,
				halign:'center',//标题居中，内容不居中
				hidden:true,
				editor:"text",
				value:10,
			}
	    ]],
	    columns: dateArray,
	    // pagination:true,
		// sortName:'id',
		// sortOrder:'Desc',
		// method:'post',
		
		onBeforeSend: function(){
		
			// alert(year);
			 year=$('#year').combobox('getValue');




			// $.ajax({
			// 			type:'POST',
			// 			url:'body/myhabit/myhabitload.php',
			// 			data:{
			// 				year: year, 
			// 				month:month,
			// 				status:$('#statuselect').combobox('getValue'),
			// 				username :$('#inputhabituser').val(),
			// 				sortName:'id',
			// 				sortOrder:'Asc',
			// 			},
			// 			beforeSend:function(){
			// 				year=$('#year').combobox('getValue');
			// 				month=$('#month').combobox('getValue');
			// 				status=$('#statuselect').combobox('getValue');
			// 			},
						
			// 	});
		
			
		},
		queryParams:{

			year: year,
			month: month,
			username :$('#inputhabituser').val(),

		},

		// 样式设置
		//striped:true,
		//nowrap:true,  //true单行，false多行。
		//fitColums:true,// 当出现滚动条时，自适应，去掉滚动条。
		fitColums:false,//用于冻结功能设置。
		rownumbers:true,//显示行号，
		singleSelect:true,//设置为true只能选定一行。
		// 工具栏
		toolbar:'#habittb',
		onBeforeSave: function(){
			// alert('我在保存前触发');
			// console.log($('#habitbox').edatagrid('options'));
		},
		onAfterEdit : function () {
			// alert('rowindex'+rowindex+'|'+'rowindex'+rowData+'|'+'changes'+changes);
			// // 新增用户
			// if(inserted.length > 0){
			// 	$.ajax({
			// 			type:'POST',
			// 			// url:'add.php',
			// 			data:{
			// 				year: year,
			// 				month: month,
			// 			},
			// 			beforeSend:function(){
							
			// 			},
						
			// 	});

			// }},
			}

	});  

	


});	






</script>







