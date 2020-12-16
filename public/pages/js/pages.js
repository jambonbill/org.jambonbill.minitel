$(()=>{
	"use strict";

	let emulator = Minitel.startEmulators()[0];

	window.emul=()=>emulator;

	let pages=[];

	function get(){

	    console.info('get');

	    let p={
	    	do:'list'
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p, (json)=>{
	        console.log(json);
	        pages=json.pages;
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
	    let dat=pages;
	    let str=$('#search').val();
	    let num=0;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th width=30>#</th>';
	    htm+='<th>Page name</th>';
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
	        htm+='<td><i class="text-muted">'+o.id;
	        htm+='<td>'+o.name;
	        htm+='<td class="text-right"><i class="text-muted">'+o.size+'</i>';
	        num++;
	    }
	    htm+='</tbody>';
	    htm+='</table>';

	    if (num>0) {
	        htm+='<i class="text-muted">'+num+' record(s)</i>';
	    } else {
	        htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
	    }

	    $('#boxPages .card-body').html(htm);
	    $('#boxPages table').tablesorter();
	    $('#boxPages tbody>tr').click(function(){
	        $('#boxPages tbody>tr').removeClass('bg-primary');
	        $(this).addClass('bg-primary');
	    	//$('.overlay').show();
	        console.log($(this).data('id'));
	        popPage($(this).data('id'));
	    });
	}

	function popNew(){
	    console.info('popNew');
	    $('#modalNewPage').modal('show');
	    $('#modalNewPage .modal-title').text('New page');
	    $('#new_name').focus();
	    $('button#btnCreate').attr('disabled',false);
	}

	function popPage(id){
	    console.info('popPage',id);
	    let o=pages.find((d)=>d.id==id);

	    if (!o) {
	        console.error('not found');
	        return;
	    }

	    console.log(o);

	    $('#modalPage').modal('show');
	    $('#modalPage .modal-title').text('Loading #'+o.id);
	    $('#page_id').val(o.id);
	    $('button#btnUpdate').attr('disabled',false);
		$('#btnDelete').attr('disabled',false).focus();
	    $('.overlay').show();

		$.post('ctrl.php', {'do':'get',id:o.id}, (json)=>{
			$('.overlay').hide();
			//console.log('load',json.data.b64);
			$('#modalPage .modal-title').text(json.data.name);
			let data=atob(json.data.b64);
			console.log(data);
			emulator = Minitel.startEmulators()[0];
			for(let i in data){
				emulator.send(data[i].charCodeAt());
			}

		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	}





	$('#btnNew').click(function(){
		popNew();
	});


	$('#btnCreate').click(function(){

		let p={
		    do:'create',
		    name:$('#new_name').val(),
		    b64:$('#new_data').val()
		};

		$('.overlay').show();
		$('#modalNewPage .modal-title').text('Please wait...');
		$('button#btnCreate').attr('disabled', true);
		$.post('ctrl.php', p, (json)=>{
			$('.overlay').hide();
			console.log(json);
			if(json.created){
				$('#modalNewPage').modal('hide');
				get();
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});


	$('#btnDelete').click(()=>{

		let id=$('#page_id').val();

		if(!confirm("Confirm delete page #"+id+" ?"))return;

		let p={
		    do:'delete',
		    id:id
		};

		$('.overlay').show();
		$('#btnDelete').attr('disabled','disabled');
		$('#modalPage .modal-title').text('Please wait');
		$.post('ctrl.php', p, (json)=>{
			$('.overlay').hide();
			console.log(json);
			if(json.deleted){
				get();
				$('#modalPage').modal('hide');
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});

	console.log("pages.js");
});