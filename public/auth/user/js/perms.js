$(()=>{
	'use strict';

	function getPermissions(){

	    console.info('getPermissions');

	    let p={
	    	do:'getPermissions',
	    	user_id:$('#user_id').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}

	getPermissions();

	function displayPermissions(dat){

	    console.info('displayPermissions');

	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th>#</th>';
	    htm+='</thead>';

	    htm+='<tbody>';
	    for(let i in dat){
		    let o=dat[i];
	        console.log(o);
		    htm+='<tr data-id="'+o.id+'">';
		    htm+='<td>'+o;
		}
	    htm+='</tbody>';
	    htm+='</table>';

	    if (dat.length>0) {
	        htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<pre>no data</pre>';
	    }


	    $('#boxPermissions .box-body').html(htm);
	    $('#boxPermissions table').tablesorter();
	    $('#boxPermissions tbody>tr').click(function(){
	    	$('.overlay').show();
	        console.log($(this).data('id'));
	        //document.location.href='';
	    });
	}
});