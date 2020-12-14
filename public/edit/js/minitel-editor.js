$(function(){
    "use strict"

    const emulator = Minitel.startEmulators()[0]
    emulator.setRefresh(1200);//default
    emulator.setRefresh(1200*100);//fast

    window.emulator=()=>emulator;

    //let ms=miniscript().clearScreen().write("READY");
    //emulator.send(ms.data);

    //Init Ace editor
    var ls=localStorage;
    //var output;//screen
    var script={};//the script db record
    var editor;
    var langTools;

    function initEditor(){

        console.info('initEditor()');

        editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");
        var JavaScriptMode = ace.require("ace/mode/javascript").Mode;
        langTools = ace.require("ace/ext/language_tools");
        editor.session.setMode(new JavaScriptMode());
        //editor.resize();

        editor.setOptions({
            fontSize: "14pt",
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });

        let n=+ls.getItem('fontSize');
        if(n>1&&n<64){
            console.log('setFontSize(n)',n);
            editor.setFontSize(n);
        }

        editor.getSession().setUseWrapMode(true);

        editor.on('change', function() {//onchange
            window.location.hash='';
            let len=editor.session.getValue().length;
        });

        editor.commands.addCommand({
            name: "Run script",
            bindKey: {win: "Ctrl-Return", mac: "Command-Return"},
            exec:(editor)=>{
                //console.warn('scriptRun();');
                runScript();
            }
        });

        editor.commands.addCommand({
            name: "Save script",
            bindKey: {win: "Ctrl-S", mac: "Command-S"},
            exec:(editor)=>{
                quicksave();
            }
        });

        editor.commands.addCommand({
            name: "Open script",
            bindKey: {win: "Ctrl-o", mac: "Command-o"},
            exec: function(editor) {
                scriptSelector((scriptId)=>{
                    loadScript(scriptId);
                });
            }
        });

        editor.commands.addCommand({
            name: "Quick Open script",
            bindKey: {win: "Ctrl-p", mac: "Command-p"},
            exec: function(editor) {
                scriptSelector((scriptId)=>{
                    loadScript(scriptId);
                });
            }
        });




        editor.commands.addCommand({
            name: "Save script as",
            bindKey: {win: "Ctrl-Shift-S", mac: "Command-Shift-S"},
            exec:(editor)=>{
                //console.warn('scriptSaveAs()');
                popSaveAs();
            }
        });

        editor.commands.addCommand({
            name: "New script",
            //bindKey: {win: "Ctrl-N", mac: "Command-Option-N"},
            bindKey: {win: "F2", mac: "F2"},
            exec: function(editor) {
                if(!confirm("New script ?"))return;
                popNew();
            }
        });

        editor.getSession().setValue('(minitel)=>{\\nminitel.send(data);};');
        let data=ls.getItem('miniscript');
        if(data){
            editor.getSession().setValue(data);
        }
    }


    initEditor();

    function scriptLoad(id){

        console.log('scriptLoad',id);

        let p={
            'do':'load',
            id:id
        };

        $('.overlay').show();
        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
            if(json.r.data){
                editor.getSession().setValue(json.r.data);
            }else{
                editor.getSession().setValue('//no data');
            }
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }


    function quicksave(){
        console.log("quicksave");
        var data=editor.getSession().getValue();
        ls.setItem("miniscript", data);

        let p={
            'do':'update',
            id:id,
            data:data
        };

        $('.overlay').show();
        $.post('ctrl.php', p, (json)=>{
            $('.overlay').hide();
            console.log(json);
        }).fail((e)=>{
            alert(e.responseText);
            console.error(e.responseText);
        }).always(()=>{
            $('.overlay').hide();
        });
    }

    function runScript(){
        console.log('runScript()');
        var data=editor.getSession().getValue();
        try{
            eval("let _x="+data+";if(typeof(_x)=='function');_x(emulator);");//i hope i'm not going to hell for this
            //eval(data);
        }
        catch(e){
            console.error("scriptRun error", e);
            //console.log(e.name,e.message);
        }
    }

    function popNew(){
        console.log("TODO");
        newScript();
    }

    /**
     * Set new script
     * @return {[type]} [description]
     */
    function newScript(){
        editor.getSession().setValue('(minitel)=>{\n\n\tlet ms=miniscript();\n\n\tminitel.send(ms.data);\n};');
    }


    document.getElementById("screen").ondblclick=function(){
        var elem = document.getElementById("screen");

        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { // Firefox
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { // Chrome, Safari and Opera
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { // IE/Edge
            elem.msRequestFullscreen();
        }

    }

    let id=$('#script_id').val();
    if(id>0){
        scriptLoad(id);
    }

});