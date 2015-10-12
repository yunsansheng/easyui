$(function () {

	$('#nav').tree({
		url : 'nav.php',
		lines : true,
		// animate:true,

		
		onDblClick: function(node) {  
		$(this).tree(node.state === 'closed' ? 'expand' : 'collapse', node.target);  
		node.state = node.state === 'closed' ? 'open' : 'closed';  
	    },
		// onLoadSuccess : function (node, data) {
		// 	if (data) {
		// 		$(data).each(function (index, value) {
		// 			if (this.state == 'closed') {
		// 				$('#nav').tree('expandAll');
		// 			}
		// 		});
		// 	}
		// },
		onClick : function (node) {
			if (node.url) {
				if ($('#tabs').tabs('exists', node.text)) {
					$('#tabs').tabs('select', node.text);
				} else {
					$('#tabs').tabs('add', {
						title : node.text,
						// iconCls : node.iconCls,
						closable : true,
						// href : node.url + '.php',
						href:node.url
					});
				}
			}
		}
	});
	
	$('#tabs').tabs({
		fit:true,
		border:false,
		// plain:true,
		tabHeight:35, 

	});
	//console.log($('#nav').tree('options'));
	
});