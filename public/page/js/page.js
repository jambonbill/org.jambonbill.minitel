$(function(){
	"use strict"

 	const emulator = Minitel.startEmulators()[0]

 	window.emu=()=>emulator;

 	function get(){
 	    //console.info('get');
 	    let p={
 	    	do:'get'
 	    };

 	    $('.overlay').show();
 	    $.post('ctrl.php',p, (json)=>{
 	        //console.log(json,json.vdt);
 	        display(json.vdt);
 	    }).fail((e)=>{
 		    alert(e.responseText);
 		    console.error(e.responseText);
 	    }).always(()=>{
 			$('.overlay').hide();
 	    });
 	}

 	get();

 	function display(b64){
 		//console.log(b64);
 		let stream=atob(b64);
 		//console.log(stream);
 		for(let i in stream){
 			let b=stream[i];
 			emulator.send(b.charCodeAt());
 		}
 	}
});
/*
window.addEventListener("load", function() {
    const emulator = Minitel.startEmulators()[0]
    let ms=miniscript();
    ms.write("READY");
    emulator.send(ms.data);
})
*/