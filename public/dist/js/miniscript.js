"use strict"
/**
 * https://github.com/jambonbill/miniscript
 * miniscript is a library that assist minitel page creation, using words.
 * (as in a language)
 * @file miniscript.js
 * @author Jambonbill
 * @version 1.0
 */

/*
===============================================================================
                           Les codes "controles" (<32).
===============================================================================

* Codes C0:

+-------------+-----+---------------------------------------------------------+
! 00 (Ctrl-@) ! NUL ! Filtre. Caractere de bourrage.                  !
! 01 (Ctrl-A) ! SOH ! Filtre. Debut RAMs, ROM.                    !
! 02 (Ctrl-B) !     ! Filtre.                             !
! 03 (Ctrl-C) !     ! Filtre.                             !
! 04 (Ctrl-D) ! EOT ! Filtre. Fin RAMs, ROM.                      !
! 05 (Ctrl-E) ! ENQ ! Renvoie la RAM 1. (M1).                     !
! 06 (Ctrl-F) !     ! Filtre.                             !
! 07 (Ctrl-G) ! BEL ! Buzzer (Bip).                       !
! 08 (Ctrl-H) ! BS  ! Curseur gauche.                         !
! 09 (Ctrl-I) ! HT  ! Curseur droit (TAB).                    !
! 0A (Ctrl-J) ! LF  ! Curseur bas.                        !
! 0B (Ctrl-K) ! VT  ! Curseur haut.                       !
! 0C (Ctrl-L) ! FF  ! Effacement de l'ecran et Home.                  !
! 0D (Ctrl-M) ! CR  ! Retour chariot (colonne 1).                 !
! 0E (Ctrl-N) ! SO  ! Passage dans le jeu semi-graphique (G1).            !
! 0F (Ctrl-O) ! SI  ! Retour au jeu normal (G0).                  !
! 10 (Ctrl-P) ! DLE ! Filtre. Caractere de transparence (M10).            !
! 11 (Ctrl-Q) ! Con ! Curseur on.                         !
! 12 (Ctrl-R) ! Rep ! Repetition du dernier caractere: n+64. Maximum: 64 fois.!
! 13 (Ctrl-S) ! Sep ! Filtre le caractere suivant aussi (Separateur).         !
! 14 (Ctrl-T) ! Coff! Curseur off.                        !
! 15 (Ctrl-U) ! NACK! Filtre.                             !
! 16 (Ctrl-V) ! SYN ! Non-documente. Idem que 19 (Ctrl-Y).            !
! 17 (Ctrl-W) !     ! Filtre.                             !
! 18 (Ctrl-X) ! CAN ! Cancel. Efface la fin de la ligne.              !
! 19 (Ctrl-Y) ! SS2 ! Introduit un caractere G2 (accents, signes speciaux...).!
! 1A (Ctrl-Z) ! SUB ! Caractere d'erreur (? a l'envers si M1/M10, DEL sinon). !
! 1B (Ctrl-[) ! ESC ! Introduit une sequence escape.                  !
! 1C (Ctrl-\) !     ! Filtre.                             !
! 1D (Ctrl-]) ! SS3 ! Filtre le caractere suivant aussi (M1B).            !
! 1E (Ctrl-^) ! RS  ! Home (1ere ligne, 1ere colonne).                !
! 1F (Ctrl-_) ! US  ! Posititionnement curseur: Pl+64 Pc+64 ou Pl sur 2digits.!
+-------------+-----+---------------------------------------------------------+

 */

const miniscript=function(){
    return {
        version:0.14,
        data:[],
        beep:function(){
            //Buzzer (Bip)
            this.put(0x07);
        },

        bgColor:function(n){
            let color=0x57;
            switch(n){
                case "red":color=0x51;break;
                case "green":color=0x52;break;
                case "yellow":color=0x53;break;
                case "blue":color=0x54;break;
                case "pink":color=0x55;break;
                case "cyan":color=0x56;break;
                case "white":color=0x57;break;
            }
            this.data.push(0x1B);//set BG color
            this.data.push(color);//colorindex
            return this;

        },

        /**
         * Enable blinking
         * @param  bool [description]
         * @return self
         */
        blink:function(b){
            //this.put(0x48);
            this.put(0x1B);
            this.put(72);//¯\_(ツ)_/¯
            /*
            if(b==false){
                this.put(0x17);
            }else{
                this.put(0x48);
            }
            */
            return this;
        },


        /**
         * Clear Minitel screen
         * @return self
         */
        clearScreen:function(){
            this.put(0x0C);
            return this;
        },


        clearScreenStart:function(){
            //
            return this;
        },

        clearScreenEnd:function(){
            //
            return this;
        },


        /**
         * Clear Current Line (at cursor position)
         * @return {[type]} [description]
         */
        clearLine:function(){
            //
            return this;
        },

        /**
         * Clear end of line (at cursor position)
         * @return {[type]} [description]
         */
        clearEol:function(){
            //
            return this;
        },


        nl:function(){//Retour chariot (colonne 1).
            this.put(0x0D);
            return this;
        },


        /**
         * Move cursor down, and at the begining of line
         * @return self
         */
        br:function(){//<br />
            this.put([0x0A,0x0D]);
            //this.put(0x13);
            return this;
        },

        box:function(x,y,width,height,color)
        {
            //TODO : Locate(x,y)
            //Draw space with color, repeat w
            //Repeat y
            //this.put([0x1F, 0x40+y%25, 0x40+x%40);//Locate

            for(let row=y;row<y+height;row++){
                this.put([
                    0x1f, 0x40 + row, 0x40 + x, //Locate
                    0x0e, 0x1b, 0x50 + color, //Fill Symbol
                    0x20, 0x12, 0x40 + width - 1 //Repeat
                ]);
            }

            return this;
        },



        clearStatus:function(){
            this.put(0x17);
            return this;
        },


        clearEol:function(){
            this.put(0x17);
            return this;
        },


        /**
         * Set the current color
         * @param  color as a string
         * @return self
         */
        color:function(n){
            let color=0x47;
            switch(n){
                case "red":color=0x41;break;
                case "green":color=0x42;break;
                case "yellow":color=0x43;break;
                case "blue":color=0x44;break;
                case "pink":color=0x45;break;
                case "cyan":color=0x46;break;
                case "white":color=0x47;break;
            }
            this.data.push(0x1B);//set FG color
            this.data.push(color);//colorindex
            return this;
        },


        cursor:function(b){//curson ON
            if(b==true){
                this.put(0x11);
            }else{
                this.put(0x14);
            }
            return this;
        },


        /**
         * In order to delay the display, we just spit 00 data.
         * consequently, delay depend on bandwidth.
         * hacky but worky
         * @param  {[type]} n [description]
         * @return {[type]}   [description]
         */
        delay:function(n){
            for(let i=0;i<n;i++)this.put(0x00);
            return this;
        },




        gfx:function(b){//switch to gfx mode
            if(b){
                this.put(0x0E);//Mode semi-graphique (mosaic)
            }else{
                this.put(0x0F);//normal Text mode
            }
            //"content-g0": [0x0f],
            //"content-g1": [0x0e],
            return this;
        },




        /**
         * Bring cursor home (1ere ligne, 1ere colonne)
         * @return this
         */
        home:function(){
            this.put(0x1E);
            return this;
        },


        invert:function(b){
            if(b===false){
                this.put([0x1B,0x5C]);
            }else{
                this.put([0x1B,0x5D]);//inverse
            }
            return this;
        },


        /**
         * move cursor to given location
         * @param  int x [column]
         * @param  int y [row]
         * @return self
         */
        /*
        locate:function(x,y){//
            this.data.push(0x1F);//move to
            this.data.push(0x40+y%25);//y first
            this.data.push(0x40+(x+1)%40);//x
            return this;
        },
        */

        /**
         * move cursor to given location
         * @param  int x [column]
         * @param  int y [row]
         * @return self
         */
        goto:function(x,y){
            this.put([0x1F,0x40+y%25,0x40+(x+1)%40]);//x
            return this;
        },


        /**
         * Move cursor left
         * @return self
         */
        left:function(){
            this.put(0x08);
            return this;
        },


        /**
         * Move cursor up
         * @return self
         */
        up:function(){
            this.put(0x0B);
            return this;
        },


        /**
         * Move cursor down
         * @return self
         */
        down:function(){
            this.put(0x0A);
            return this;
        },



        /**
         * Add message to queue
         * @param  {[type]} b [description]
         * @return {[type]}   [description]
         */
        put:function(b){
            if(typeof b=="object"){
                //todo
                for(let i in b){
                    this.data.push(b[i]);
                }
            }else{
                this.data.push(b);
            }
            return this;
        },


        /**
         * TODO
         * @param  {[type]} n [description]
         * @return {[type]}   [description]
         */
        repeat:function(n){//Repetition du dernier caractere: n+64. Maximum: 64 fois.!
            this.put([0x12, n%64]);
            return this;
        },


        /**
         * Move cursor right
         * @return self
         */
        right:function(){
            //Curseur droit (TAB).
            this.put(0x09)
            return this;
        },


        /**
         * Set normal size
         * @return self
         */
        sizeNormal:function(){
            this.put([0x1B,0x4C]);
            return this;
        },


        /**
         * Set double height
         * @return self
         */
        sizeDoubleHeight:function(){
            this.put([0x1B,0x4D]);
            return this;
        },


        /**
         * Set double width
         * @return self
         */
        sizeDoubleWidth:function(){
            this.put([0x1B,0x4E]);
            return this;
        },


        /**
         * Set double size
         * @return self
         */
        sizeDouble:function(){
            this.put([0x1B,0x4F]);
            return this;
        },


        /**
         * Add ASCII String
         * @param  string str [description]
         * @return self
         */
        write:function(str){
            // Add a Ascii string
            // I should make sure its lmited to printables
            for(let i in str){
                //special chars: Dédé à où relève Français
                //-> add 0x19
                switch(str[i]){

                    case 'ç':
                        this.put([0x19,75,99]);//c
                        continue;


                    case 'é':
                        this.put([0x19,66,101]);
                        continue;


                    case 'è':
                        this.put([0x19,65,101]);
                        continue;

                    case 'ê':
                        this.put([0x19,67,101]);//e
                        continue;

                    case 'ù':
                        this.put([0x19,65,117]);
                        continue;


                    case 'à':
                        this.put([0x19,65,97]);
                        continue;

                    case '’'://replace with '
                        this.put(39);continue;
                        break;

                }

                this.put(str.charCodeAt(i));
            }
            return this;
        },

        /**
         * Return base64 encoded data
         * @return {[type]} [description]
         */
        btoa:function(){
            return btoa(this.data);
        }
    }
}
