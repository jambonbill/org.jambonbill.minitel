$(()=>{
	'use strict';



	$('#boxUser input, #boxUser select').change(function(){
		highLightChange();
	});

	function highLightChange(){
		$('#btnSave').addClass("btn-primary").removeClass("btn-default");
		$('#btnSave').attr("disabled",false);
	}


	$('#btnSave').click(function(){

		if(!$('#email').val()){
			console.error("no email");
			return;
		}

		let p={
		    'do':'update',
		    user_id:$('#user_id').val(),
		    email:$('#email').val(),
		    first_name:$('#first_name').val(),
		    last_name:$('#last_name').val(),
		    //aup_gender:$('#aup_gender').val(),
		    //aup_date_of_birth:$('#aup_date_of_birth').val(),
		    //aup_nationality:$('#aup_nationality').val(),
		    //aup_country:$('#aup_country').val(),
		    //aup_phone_number:$('#aup_phone_number').val(),
		    //aup_mailing_address:$('#aup_mailing_address').val(),
		    is_active:$('#is_active').val(),
		    is_staff:$('#is_staff').val()
		};

		//console.log(p);return;

		//$('.overlay').show();
		$('#btnSave').attr("disabled",true);
		$.post('ctrl.php', p, function(json){
			//$('.overlay').hide();
			$('#btnSave').addClass("btn-default").removeClass("btn-primary");
			console.log(json);
		}).fail(function(e){
			alert(e.responseText);
			console.error(e.responseText);
		}).always(function(){
			$('.overlay').hide();
		});
	});

	$('#btnDelete').click(()=>{

		if(!confirm("Confirm de-activate this user ?"))return;

		let p={
		    do:'deactivate',
		    user_id:$('#user_id').val()
		};

		$('.overlay').show();
		$.post('ctrl.php', p, (json)=>{
			$('.overlay').hide();
			console.log(json);
			if(json.updated){
				document.location.reload();
			}
		}).fail((e)=>{
			alert(e.responseText);
			console.error(e.responseText);
		}).always(()=>{
			$('.overlay').hide();
		});
	});

	$('#btnAgent').click(()=>{
		popAgents();
	});

	window.popAgents=function(){
		console.log('popAgents()');
		$('#modalAgents').modal('show');
		getAgents();
	}

	let agents=[];
	function getAgents(){
	    console.info('getAgents()');
	    let p={
	    	do:'getAgents',
	    	user_id:$('#user_id').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p, (json)=>{
		    console.log(json);
		    agents=json.agents;
		    display();
	    }).fail((e)=>{
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(()=>{
			$('.overlay').hide();
	    });

	    function display(){
		    console.info('display() agents');
		    let dat=agents;
		    //let str=$('#search').val();
		    let num=0;
		    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

		    htm+='<thead>';
		    //htm+='<th>#</th>';
		    htm+='<th>User agent</th>';
		    //htm+='<th>IP</th>';
		    htm+='<th>Date</th>';
		    htm+='</thead>';

		    htm+='<tbody>';
		    for(let i in dat){
		        let o=dat[i];
		        /*
		        if(str){
		            let reg=new RegExp(str,'i');
		            let match=false;
		            if(!match)continue;
		        }
		        */
		        console.log(o);
		        htm+='<tr data-id="'+o.id+'">';
		        //htm+='<td>'+o.aua_id;
		        htm+='<td>'+o.aua_user_agent;
		        //htm+='<td>'+o.aua_ip;
		        htm+='<td><span class="badge badge-light">'+o.aua_created.substr(0,10)+'</span>';
		        //htm+='<span class="badge badge-light">'+o.aua_created.substr(0,10)+'</span>';
		        num++;
		    }
		    htm+='</tbody>';
		    htm+='</table>';

		    if (num>0) {
		        //htm+='<i class="text-muted">'+num+' record(s)</i>';
		    } else {
				htm='<div class="p-4"><div class="alert alert-secondary" role="alert">no data</div></div>';
		    }

		    $('#modalAgents .modal-body').html(htm);
		    $('#modalAgents table').tablesorter();
		    $('#modalAgents tbody>tr').click(function(){
		    	//$('.overlay').show();
		        console.log($(this).data('id'));
		        //document.location.href='';
		    });
		}
	}




	$('#btnPassword').click(()=>changePassword());

	window.changePassword=function(){

		let pw=prompt("Enter new password","password");
		if(!pw)return;

		let p={
		    do:'updatePassword',
		    user_id:$('#user_id').val(),
		    pw:pw
		};

		$('.overlay').show();
		$.post('ctrl.php', p, function(json){
			$('.overlay').hide();
			console.log(json);
			if (json.updated) {
				alert("Password updated!");
			}
		}).fail(function(e){
			alert(e.responseText);
			console.error(e.responseText);
		}).always(function(){
			$('.overlay').hide();
		});
	}

	console.log('user.js');

});