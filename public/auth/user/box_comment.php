<?php
/*
 * Box user comment(s)
 */

$htm='<div class="row">';
$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
//$htm.='<label>Legend</label>';
$htm.='<textarea class="form-control" placeholder="Comment" id=comment></textarea>';
$htm.='<button class="btn btn-default btn-sm" id=btnComment disabled><i class="fa fa-plus-circle"></i> Add comment</button>';
$htm.='</div>';
$htm.='</div>';
$htm.='<div class="col-12" id=comments>';
$htm.='</div>';
$htm.='</div>';


$box=new LTE\Card;
$box->id("boxComment");
$box->title("Comment(s)");
//$box->icon("fa fa-edit");
$box->body($htm);
//$box->p0(1);
//$box->collapsable(1);
echo $box;
?>
<script type="text/javascript">
$(()=>{

	$('#comment').change(function(){
		let val=$('#comment').val();
		if (val) {
			$('#btnComment').attr('disabled',false).addClass("btn-primary").removeClass('btn-default');
		}else{
			$('#btnComment').attr('disabled',true).addClass("btn-default").removeClass('btn-primary');
		}
	});


	$('#btnComment').click(function(){

		let p={
		    'do':'comment',
		    user_id:$('#user_id').val(),
		    comment:$('#comment').val()
		};

		$('#btnComment').attr('disabled',true);
		$.post('ctrl.php', p, function(json){

			console.log(json);
			if(json.created){
				$('#comment').val('');
				getComments();
			}
		}).fail(function(e){
			alert(e.responseText);
			console.error(e.responseText);
		}).always(function(){
			$('#btnComment').attr('disabled',false);
		});
	});

	function getComments(){

	    console.info('getComments');

	    let p={
	    	'do':'getComments',
	    	user_id:$('#user_id').val()
	    };

	    $('.overlay').show();
	    $.post('ctrl.php',p,function(json){
		    $('.overlay').hide();
		    console.log(json);
		    displayComments(json.comments);
	    }).fail(function(e){
		    alert(e.responseText);
		    console.error(e.responseText);
	    }).always(function(){
			$('.overlay').hide();
	    });
	}

	getComments();

	function displayComments(dat){

	    console.info('displayComments');

	    let htm='';

	    for(let i in dat){
		    let o=dat[i];
	        console.log(o);
		    //htm+='<tr data-id="'+o.id+'">';
		    //htm+='<td>'+o;
		    htm+='<div class="direct-chat-msg">';
                htm+='<div class="direct-chat-info clearfix">';
                  htm+='<span class="direct-chat-name float-left">'+o.username+'</span>';
                  htm+='<span class="direct-chat-timestamp float-right">'+o.auc_created+'</span>';
                htm+='</div>';
                //<!-- /.direct-chat-info -->
                htm+='<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="message user image">';
                //<!-- /.direct-chat-img -->
                htm+='<div class="direct-chat-text">';
                  htm+=o.auc_comment;
                htm+='</div>';
                //<!-- /.direct-chat-text -->
              htm+='</div>';
		}
	    /*
	    if (dat.length>0) {
	        htm+='<i class="text-muted">'+dat.length+' record(s)</i>';
	    } else {
	        htm='<pre>no data</pre>';
	    }
	    */
	    $('div#comments').html(htm);

	}
});
</script>