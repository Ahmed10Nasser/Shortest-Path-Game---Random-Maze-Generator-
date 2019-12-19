
<html>
<head>
<?php
    if(isset($_GET['level'])) {
        $level = intval($_GET['level']);
    }
    else{
        $level = 1;
    }
        $myfile = fopen("level.txt", "w") or die("Unable to open file!");
           fwrite($myfile, $level);
           fclose($myfile);
        $filename = shell_exec("main.exe");
        echo $filename;
       ?>
    <title>الكلب الحيران نان نان</title>
    <script src = "jquery.js" type = "text/javascript"></script>
    <script src = "keyboard.js" type = "text/javascript"></script>
    <script src = "utility.js" type = "text/javascript"></script>
    <script src = "canvas.js" type = "text/javascript"></script>
    <script src = "animate.js" type = "text/javascript"></script>
    <script src = "spritesheet.js" type = "text/javascript"></script>
    <script src = "sprite.js" type = "text/javascript"></script>
    <script src = "world.js" type = "text/javascript"></script>
    <script src = "bootstrap.min.js" type = "text/javascript"></script>
    <link href='bootstrap.min.css' rel="stylesheet">
    
    <script>
        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var level = url.searchParams.get("level") || 1;
        if(level < 10){
            var new_level = (Number(level)+1);
        } else{
            new_level = level;
        }
        
    $(function() {
        $("#levelnumber").html("Current level: "+level);
        $('.newmap').click(function() {
            $.get('ajax.php', function(data) {
                document.location.reload(true);
            });
            return false;
        });
    });
</script>
<script>
    $(function() {
        $('.newlevel').click(function() {
            $.get('increment.php', function(data) {
                document.location.reload(true);
            });
            return false;
        });
    });
</script>
    <script language = "javascript">
        
        var user_score = 0;
        var Context = null;
        var BLOCK_W = 96;
        var BLOCK_H = 96;

        var dog_x = 16;
        var dog_y = 0;
        var dog_angle = 0;
        var dog_rotate = 0;
        var wall = new Sprite("wall.png");
        var water = new Sprite("water.png");
        var cross_one = new Sprite("cross_one.png");
        var cross_two = new Sprite("cross_two.png");
        var cross_both = new Sprite("cross_both.png");
        var cross_hz = new Sprite("cross_hz.png");
        var cross_vr = new Sprite("cross_vr.png");
        var tresure = new Sprite("tresaure.png");
        var flag = new Sprite("flag.png");
        var dog = new Sprite("dog-sprite-sheet.png");
        var dog2 = new Sprite("dog-sprite-sheet.png");

        var spritesheet = new Spritesheet("dog-sprite-sheet.png");
        var dog3 = new Sprite(spritesheet);
        var dog4 = new Sprite(spritesheet);
        var dog5 = new Sprite(spritesheet);

        var dog_is_moving = false;
        var dog_direction = 0;

        <?php echo file_get_contents("ds.txt"); ?> 

        var dog_i;
        var dog_j;
        var getInd_flag = true;
        var splitted = [];
        var mapIndex = 0;
        var tileType;
        var trueflag = true;
        

        $(document).ready(function(){
            Context = new HTML("game", dim*96, dim*96);
            InitializeKeyboard();

            // DisableScrollbars();

            InitializeAnimationCounters();
        });

        setInterval(function(){
            ResetAnimationCounter();
            
            DrawMap();

            dog_is_moving = false;
            
dog_direction = 0;

if (key.a) { 
    dog_x -= 1;  dog_direction |= DIR_W; dog_is_moving = true;
    }
if (key.d) { 
    dog_x += 1; dog_direction |= DIR_E; dog_is_moving = true;  
    }
if (key.w) { 
    dog_y -= 1;    dog_direction |= DIR_N; dog_is_moving = true; 
     }
if (key.x) {
    dog_y += 1;  dog_direction |= DIR_S; dog_is_moving = true;  
     }
if (key.e) { 
    dog_x += 1;dog_y -= 1;  dog_direction |= DIR_NE; dog_is_moving = true;
    }
    if (key.q) { 
    dog_x -= 1;dog_y -= 1;  dog_direction |= DIR_NW; dog_is_moving = true;
    }
    if (key.c) { 
    dog_x += 1;dog_y += 1;  dog_direction |= DIR_SE; dog_is_moving = true;
    }
    if (key.z) { 
    dog_x -= 1;dog_y += 1;  dog_direction |= DIR_SW; dog_is_moving = true;
    }



// Animated characters
var dog_seq = 0;

if (dog_is_moving)
{
    
    if (dog_direction & DIR_W) dog_seq = [33,34,35,36];
    if (dog_direction & DIR_E) dog_seq = [1,2,3,4];
    if (dog_direction & DIR_N) dog_seq = [49,50,51,52];
    if (dog_direction & DIR_S) dog_seq = [17,18,19,20];
    if (dog_direction & DIR_NE) dog_seq = [57,58,59,60];
    if (dog_direction & DIR_NW) dog_seq = [41,42,43,44];
    if (dog_direction & DIR_SE) dog_seq = [9,10,11,12];
    if (dog_direction & DIR_SW) dog_seq = [25,26,27,28];
    
    // Finally, animate the dog.
    dog.draw(dog_x, dog_y, dog_seq);
    
}
else
{
    dog.draw(dog_x, dog_y, 0);
}

        }, 5);
        
    </script>
    <script type='text/javascript'>
        $(window).ready(function(){
            setInterval(function(){
                if(Math.floor(dog_x/96) == dim-1 && Math.floor(dog_y/96) == dim-1 && user_score == res){
                    $("#exampleModalCenter2").show();
                    $(".user_score").css({"color":"green"});
                    $("#exampleModalCenter2").addClass("show");
                    
                }
                if(user_score > res){
                    $("#exampleModalCenter").show();
                    $("#exampleModalCenter").addClass("show");
                    $(".container").css({"opacity":"0"});
                    dog_x = -999;
                    dog_y = -999;
                }
            $("#score").html("<span class='user_score'>"+user_score+"</span>/"+res);
            if(user_score > res/2 && !(user_score == res)) {
                    $(".user_score").css({"color":"orange"});
                }
            },5);
        });
        </script>
        <style>
    html,body{margin:0;padding:0;background:#61b6dd url(water.png) repeat};
    .menu-bar, #score{
        background-color:
rgba(255,255,255,0.75);
box-shadow: 0 5px 15px -9px;
border-radius: 13px;
padding: 10px 35px;
color:
#000;
text-align: right;
margin-left: -5px;
border: 2px solid
#000;
display: inline-block;
    }
    .levelprogress{
        position: fixed;

top: 15px;

left: 15px;
    }
    .progress{    
        border-radius:40px;
        position: fixed;

top: 15px;

right: 15px;

font: bold 24px Arial;

display: block;

width: 243px;

background:
rgba(255,255,255,0.7);

padding: 16px 20px 39px;

text-align: center;

border: 1px solid
rgba(0,0,0,0.4);

box-shadow: 0px 3px 14px
rgba(0,0,0,0.3);
    }
    .container{position:relative;z-index:999}
    </style>
</head>
<body>
    <div class='container'>
    <div class='progress levelprogress'>
        <div id='levelnumber'></div>
        </div>
        <div class='progress'>
        <div id='score'></div>
        </div>
    </div>
       <div id="gamecont" style="position:relative;top:60px;display:block;margin:0 auto;text-align:center"><canvas id = "game"></canvas></div>
    <br>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">ATTENTION</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style='text-align:center'>
                      <h2 style="color:red">You lost.</h2>
                      <hr>
                      <p>Here's what you can do</p>
                      <p>
                          <a class='btn btn-info newmap' > Do different map, same level. </a>
                      </p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">ATTENTION</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style='text-align:center'>
                      <h2 style="color:green">You won.</h2>
                      <hr>
                      <p>Here's what you can do</p>
                      <p>
                          <a class='btn btn-warning newmap'> Do different map, same level. </a>
                      </p>
                      <p>
                          <a class='btn btn-success' onclick="location.href='?level='+new_level;return false;"> Go to the next level. </a>
                      </p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
</body>
</html>