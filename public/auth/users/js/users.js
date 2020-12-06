$(()=>{
	'use strict';
	let dat=[];

	function get(){
	    console.info('get()');
	    let p={
	    	do:'get',
	    	search:$('input#search').val(),
	    	role:$('select#role').val(),
	    	group_id:$('select#group').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
		    dat=json.users;
		    display();
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}

	get();

	function display(){

	    console.info('display()');

	    let str=$('#search').val();
	    let num=0;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';
	    htm+='<thead>';
	    htm+='<th width=20>#</th>';
	    htm+='<th>username</th>';
	    htm+='<th>email</th>';
	    htm+='<th class="d-none d-lg-table-cell" width=180>last login</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];

	        if(str){
	        	let match=false;
	        	let reg=new RegExp(str,'i');
	        	if(reg.test(o.username))match=1;
	        	if(reg.test(o.email))match=1;
	        	if(!match)continue;
	        }

		    if (o.is_active) {
				htm+='<tr data-id="'+o.id+'">';
		    }else{
		    	htm+='<tr data-id="'+o.id+'" class="text-muted">';
		    }

		    htm+='<td><i class="text-muted">'+o.id+'</i>';

		    htm+='<td>';//Username
		    htm+=o.username;
		    if (o.is_staff) {
		    	htm+=' <span class="badge badge-light">staff</span>';
		    }



		    htm+='<td>'+o.email;

		    htm+='<td class="d-none d-lg-table-cell">';
		    if(o.last_login)htm+=o.last_login;
		    num++;
		}
	    htm+='</tbody>';
	    htm+='</table>';

	    if (dat.length>0) {
	        //htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	        $('#boxUsers .card-title').html(num+" user(s)");
	    } else {
	        htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
	    }

	    $('#boxUsers .card-body').html(htm);
	    $('#boxUsers table').tablesorter();
	    $('#boxUsers tbody>tr').click(function(){
	    	$('.overlay').show();
	        console.log($(this).data('id'));
	        document.location.href='/auth/user/'+$(this).data('id');
	    });
	}

	window.popNewUser=()=>{
		$('#modalUserNew').modal('show');
		$('#email').focus();
	}

	$('#btnNewUser').click(()=>popNewUser());

	$('#btnCreate').click(()=>{

		if(!fnew.reportValidity())return false;

		if(!$('#email').val()){
			$('#email').focus();
		}

		let p={
		    do:'create',
		    email:$('#email').val(),
		    first_name:$('#first_name').val(),
		    last_name:$('#last_name').val()
		};

		$('.overlay').show();

		$.post('ctrl.php', p, function(json){
			$('.overlay').hide();

			console.log(json);

			if(json.user_id){
				document.location.href="/auth/user/"+json.user_id;
			}

			if(json.error){
				alert(json.error);
				console.error(json.error);
			}

		}).fail(function(e){
			alert(e.responseText);
			console.error(e.responseText);
		}).always(function(){
			$('.overlay').hide();
		});
	});

	$('#search').keyup(()=>get());
	$('#search').change(()=>get());
	$('#role, #group').change(()=>get());

	console.log('users.js');
});