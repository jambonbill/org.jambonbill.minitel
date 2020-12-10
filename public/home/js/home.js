$(function(){
	"use strict";

	let scripts=[];

	const emulator = Minitel.startEmulators()[0];


	function get(){

	    console.info('get');

	    let p={
	    	do:'get'
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p, (json)=>{
	        console.log(json);
	        scripts=json.scripts;
	        display();
	    }).fail((e)=>{
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(()=>{
			$('.overlay').hide();
	    });
	}

	get();

	function display(){

	    console.info('display');
	    let dat=scripts;
	    let str=$('#search').val();
	    let num=0;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th width=30>#</th>';
	    htm+='<th>Name</th>';
	    htm+='<th class="text-right">Size</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
	        let o=dat[i];
	        if(str){
	            let reg=new RegExp(str,'i');
	            let match=false;
	            if(!match)continue;
	        }
	        console.log(o);
	        htm+='<tr data-id="'+o.id+'">';
	        htm+='<td><i class="text-muted">'+o.id+'</i>';
	        htm+='<td>'+o.name;
	        htm+='<td class="text-right">';
	        htm+='<i class="text-muted">0</i>';
	        num++;
	    }
	    htm+='</tbody>';
	    htm+='</table>';

	    if (num>0) {
	        //htm+='<i class="text-muted">'+num+' record(s)</i>';
	    } else {
	        htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
	    }

	    $('#boxScripts .card-body').html(htm);
	    $('#boxScripts table').tablesorter();
	    $('#boxScripts tbody>tr').click(function(){
	        $('#boxScripts tbody>tr').removeClass('bg-primary');
	        $(this).addClass('bg-primary');
	    	//$('.overlay').show();
	        console.log($(this).data('id'));
	        popScript($(this).data('id'));
	    });
	}

	function popScript(id){
	    console.info('popScript',id);
	    let o=scripts.find((d)=>d.id==id);
	    if(!o){
	        console.error('not found');
	        return;
	    }
	    console.log(o);
	    $('#modalScript').modal('show');
	    $('#modalScript .modal-title').text(o.name);
	    $('#script_id').val(o.id);
	    $('button#btnEdit').focus();
	}



	function popNew(){
	    console.info('popNew');
	    $('#modalNewScript').modal('show');
	    $('#modalNewScript .modal-title').text('New script');
	    $('#new_name').focus();
	    $('button#btnUpdate').attr('disabled',false);
	}

	//Pop New F2
	$('#btnNew').click(()=>popNew());

	$('#btnCreateNewScript').click(()=>{

		let p={
		    do:'create',
		    name:$('#new_name').val()
		};

		$('.overlay').show();
		$.post('ctrl.php', p, (json)=>{
			$('.overlay').hide();
			console.log(json);
			if (json.created) {
				document.location.reload();//brutal
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});

	$('#btnEdit').click(()=>{});

	$('#btnDelete').click(()=>{
		let id=$('#script_id').val();

		if(!confirm("Confirm delete script #"+id+" ?"))return;

		let p={
		    do:'delete',
		    id:id
		};

		$('.overlay').show();
		$('#modalScript .modal-title').text('Please wait');
		$.post('ctrl.php', p, (json)=>{
			$('.overlay').hide();
			console.log(json);
			if(json.deleted){
				$('#modalNewScript').modal('hide');
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});


});