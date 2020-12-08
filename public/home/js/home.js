$(function(){
	"use strict";

	let scripts=[];

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
	    let dat=dat;
	    let str=$('#search').val();
	    let num=0;
	    let htm='<table class="table table-sm table-hover" style="cursor:pointer">';

	    htm+='<thead>';
	    htm+='<th>#</th>';
	    htm+='<th>Name</th>';
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
	        htm+='<td>'+o;
	        num++;
	    }
	    htm+='</tbody>';
	    htm+='</table>';

	    if (num>0) {
	        htm+='<i class="text-muted">'+num+' record(s)</i>';
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
	        //document.location.href='';
	    });
	}



	function popNew(id){
	    console.info('popNew',id);
	    let o=dat.find((d)=>d.id==id);
	    if(!o){
	        console.error('not found');
	        return;
	    }
	    console.log(o);
	    $('#modalNew').modal('show');
	    $('#modalNew .modal-title').text('xxx');
	    $('#x').focus();
	    $('button#btnUpdate').attr('disabled',false);
	}

	//Pop New F2
	$('#btnNew').click(()=>popNew());

});