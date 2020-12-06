//user groups
$(()=>{
	'use strict';

	let groups=[];

	function getGroups(){
	    console.info('getGroups()');

	    let p={
	    	do:'getGroups',
	    	user_id:$('#user_id').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
		    groups=json.groups;
		    displayGroups();
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}



	function displayGroups(){

	    console.info('displayGroups()');
	    let dat=groups;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th width=20>#</th>';
	    htm+='<th>Group name</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];
	        console.log(o);
		    htm+='<tr data-id="'+o.id+'">';
		    htm+='<td><i class="text-muted">'+o.id;
		    htm+='<td>'+o.name;
		    htm+=' <a href="/auth/group/'+o.id+'"><i class="fas fa-angle-double-right"></i></a>';
		}
	    htm+='</tbody>';
	    htm+='</table>';

	    if (dat.length>0) {
	        //htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
	    }

	    $('#boxGroups .card-body').html(htm);
	    $('#boxGroups table').tablesorter();
	    $('#boxGroups tbody>tr').click(function(){
	    	//$('.overlay').show();
	        console.log('clic',$(this).data('id'));
	        user_id=$(this).data('id');
	        $('#btnDelUser').attr('disabled',false);

	    });
	}

	$('#btnAddGroup').click(()=>{
		$('#modalGroups').modal('show');//POP MODAL
	});


	$('#modalGroups tbody>tr').click(function(){
		console.log($(this).data('id'));
		//if(!confirm("Add group #"+$(this).data('id')+" ?"))return;

		let p={
		    do:'groupUserAdd',
		    group_id:$(this).data('id'),
		    user_id:$('#user_id').val()
		};

		$('.overlay').show();
		$.post('ctrl.php', p, (json)=>{
			console.log(json);
			if(json.created){
				$('#modalGroups').modal('hide');
				getGroups();
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});


	getGroups();
	console.log('group.js');
});