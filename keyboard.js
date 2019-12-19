var Keyboard = function() {
    this.left = 0;
    this.right = 0;
    this.up = 0;
    this.down = 0;
    this.w = false;
    this.z = false;
    this.a = false;
    this.d = false;
    this.q = false;
    this.e = false;
    this.c = false;
    this.x = false;
};

// ASCII codes
var KEY_LEFT = 37;
var KEY_RIGHT = 39;
var KEY_UP = 38;
var KEY_DOWN = 40;
var KEY_W = 87;
var KEY_Z = 90;
var KEY_A = 65;
var KEY_D = 68;
var KEY_Q = 81;
var KEY_E = 69;
var KEY_C = 67;
var KEY_X = 88;

var DIR_E = 1;
var DIR_NE = 2;
var DIR_N = 4;
var DIR_NW = 8;
var DIR_W = 16;
var DIR_SW = 32;
var DIR_S = 64;
var DIR_SE = 128;

var nasser_x = 0;
var nasser_y = 0;
/*
var valid_left = dog_x - 96 > 0;
var valid_right = dog_x + 96 < dim*96;
var valid_top = dog_y - 96 > 0;
var valid_bottom = dog_y + 96 < dim*96;
*/
var isShift = false;
//var key = [false, false, false, false];
window.key = null;

var isThereWater = function(xx,yy){
    dog_j = Math.floor((xx+dog_x)/96);
    dog_i = Math.floor((yy+dog_y)/96);
    if((map[(dog_i*dim)+dog_j] == 'W' || map[(dog_i*dim)+dog_j] == 'W,W')){
        return true;
    } else if( (xx == yy) ){
        if (map[(dog_i*dim)+dog_j].includes(',W'))
            {
                var dg = map[(dog_i*dim)+dog_j].split(',')[0];
                user_score += Number(dg);
            return false;
        }
            else if(map[(dog_i*dim)+dog_j].includes('W,')){
                return true;
            }
            var dg = map[(dog_i*dim)+dog_j].split(',')[0];
            user_score += Number(dg);
    } else if( (xx == -1*yy) ){
        if (map[(dog_i*dim)+dog_j].includes('W,')){
            var dg = map[(dog_i*dim)+dog_j].split(',')[1];
            user_score += Number(dg);
            return false;
        } else if(map[(dog_i*dim)+dog_j].includes(',W')){
                return true;
            }
            var dg = map[(dog_i*dim)+dog_j].split(',')[1];
            user_score += Number(dg);
    }
    else{
        var dg = map[(dog_i*dim)+dog_j];
            user_score += Number(dg);
        return false;
    }
}
function InitializeKeyboard()
{
    
    window.key = new Keyboard();
    $(document).keydown(function(e) {
        if (e.keyCode == 16) isShift = true;
        // NORTH-EAST
        if (e.keyCode == KEY_E && (dog_y - 96 > 0) && (dog_x + 96 < dim*96) && !isThereWater(96,-96)) { 
            var nasser_x = dog_x;
            var nasser_y = dog_y;
            key.e = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while((dog_x - nasser_x > 192) && (nasser_y - dog_y > 192)){
                    key.e = false; 
                    nasser_x = dog_x;
                    nasser_y = dog_y;
                    break;
                }
            },5)
        }
        // NORTH-WEST
        if (e.keyCode == KEY_Q && (dog_y - 96 > 0) && (dog_x - 96 > 0) && !isThereWater(-96,-96)) { 
            var nasser_x = dog_x;
            var nasser_y = dog_y;
            key.q = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while((nasser_x - dog_x > 192) && (nasser_y - dog_y > 192)){
                    key.q = false; 
                    nasser_x = dog_x;
                    nasser_y = dog_y;
                    break;
                }
            },5)
        }
        // SOUTH-EAST
        if (e.keyCode == KEY_C && (dog_y + 96 < dim*96) && (dog_x + 96 < dim*96) && !isThereWater(96,96)) { 
            var nasser_x = dog_x;
            var nasser_y = dog_y;
            key.c = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while((dog_x - nasser_x > 192) && (dog_y - nasser_y > 192)){
                    key.c = false; 
                    nasser_x = dog_x;
                    nasser_y = dog_y;
                    break;
                }
            },5)
        }
        // SOUTH-WEST
        if (e.keyCode == KEY_Z && (dog_y + 96 < dim*96) && (dog_x - 96 > 0) && !isThereWater(-96,96)) { 
            var nasser_x = dog_x;
            var nasser_y = dog_y;
            key.z = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while((nasser_x - dog_x > 192) && (dog_y - nasser_y > 192)){
                    key.z = false; 
                    nasser_x = dog_x;
                    nasser_y = dog_y;
                    break;
                }
            },5)
        }
        // LEFT
        if (e.keyCode == KEY_A && (dog_x - 96 > 0) && !isThereWater(-96,0)) { 
            var nasser_x = dog_x;
            key.a = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while(nasser_x - dog_x > 192){
                    key.a = false; 
                    nasser_x = dog_x;
                    break;
                }
            },5)
        }
        // RIGHT
        if (e.keyCode == KEY_D && (dog_x + 96 < dim*96) && !isThereWater(96,0)) { 
            var nasser_x = dog_x;
            key.d = true; 
            getInd_flag = true;
            trueflag = true;
            setInterval(function(){
                while(dog_x - nasser_x > 192){
                    key.d = false; 
                    nasser_x = dog_x;
                    break;
                }
            },5)
            
        }
        // UP
        if (e.keyCode == KEY_W && (dog_y - 96 > 0) && !isThereWater(0,-96)) { 
            var nasser_y = dog_y;
            key.w = true; 
            getInd_flag = true;
            setInterval(function(){
                while(nasser_y - dog_y > 192){
                    key.w = false; 
                    nasser_y = dog_y;
                    break;
                }
            },5) }
            // DOWN
        if (e.keyCode == KEY_X && (dog_y + 96 < dim*96) && !isThereWater(0,96)) { 
            var nasser_y = dog_y;
            key.x = true; 
            getInd_flag = true;
            setInterval(function(){
                while(dog_y - nasser_y > 192){
                    key.x = false; 
                    nasser_y = dog_y;
                    break;
                }
            },5)
        }
        
    });
    /*
    $(document).keyup(function(e) {
        if (e.keyCode == 16) isShift = false;
        if (e.keyCode == KEY_LEFT) {  key.left = false;}
        if (e.keyCode == KEY_RIGHT) { 
            key.right = false;
        }
        if (e.keyCode == KEY_UP) { 
            key.up = false;
             }
        if (e.keyCode == KEY_DOWN) { key.down = false; }
    });
    */
    
}
