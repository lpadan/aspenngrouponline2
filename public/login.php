<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location:index.php");
    exit;
}

$display = $_GET['display'] ?? null;

function isLocalHost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

if (isLocalHost()) {
    $root = "//localhost/aspengroup.online";
    define("ROOT", $root);
    $bareRoot =  "//localhost";
    define("BARE_ROOT", $bareRoot);
    $documentRoot = $_SERVER['DOCUMENT_ROOT'] . "/aspengroup.online"; 
    define("DOCUMENT_ROOT",$documentRoot); // local file system root: /Users/lpadan/Software/aspengroup
} else {
    $root = "https://aspengroup.online";
    define("ROOT", $root);
    $bareRoot = "https://aspengroup.online";
    define("BARE_ROOT", $bareRoot);
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    define("DOCUMENT_ROOT",$documentRoot); // webserver file system root: public_html
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    
    <!-- <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
    
    <title>Aspen Group Online</title>
    <link rel="shortcut icon" href="img/ag_favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <?php
        $filemtime = filemtime(DOCUMENT_ROOT . "/public/css/custom.css");
        echo '<link rel="stylesheet" href=' . ROOT . '/css/custom.css?' . $filemtime . '">';
    ?>
</head>

<style>
    .white-skin .navbar .navbar-nav .nav-item a {
        font-size:14px
    }

</style>

<body class="fixed-sn white-skin animated slow">

<div id="container" class="view">
 
    <!--******************* snow div *********************-->
    <div class="snow wow fadeIn animated" count="1000">
        
        <div class="mask d-flex justify-content-center align-items-center ">
            
            <?php
            if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in']) || $display) { 
                echo '<div id="logoDiv" class="animated fast" style="display:none">';
            } else {
                echo '<div id="logoDiv" class="animated fast">';
            } ?>

                <div id="logo" class="text-center white-text mx-5 wow fadeIn animated" data-wow-delay=".8s">
                    <div class="display-4 mb-4" style="max-width:350px">
                        <img src="img/ag_logo_whiteGrey.png" class="img-fluid" style="margin:auto">
                        <button type="button" class="login-btn btn blue-gradient" onClick="showLogin()">Log In</button>
                    </div>
                </div>

            </div>

            <?php
                if ($display) {
                    echo '<div id="loginDiv" class="animated fast">';
                } else {
                    echo '<div id="loginDiv" style="display:none" class="animated fast">';
                }
            ?>
            

                <div id="login" class="text-center white-text mx-5">
                    <div class="card" style="width:100%">
                        
                        <div class="card-body">

                            <h2 style="text-align:left" class="title">Login</h2>

                            <div id="login_error" class="form-group animated" style="width:100%;display:none">
                                <div style="margin-top:20px; background-color:#e84c3d; color:white; padding:10px 20px" >
                                    <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>&nbsp;<span id="login_error_message"></span></p>
                                </div>
                            </div>


                            <form style="width:400px;margin:auto">
                                <!-- <div class="md-form">
                                    <input type="text" id="email" class="form-control" autocomplete="off" onkeypress="handle(event)">
                                    <label for="email">Email</label>
                                </div> -->

                                <div class="md-form">
                                    <input type="text" id="userName" class="form-control" autocomplete="off" onkeypress="handle(event)">
                                    <label for="userName">User Name</label>
                                </div>

                                <div class="md-form">
                                    <input type="password" id="password" class="form-control" onkeypress="handle(event)">
                                    <label for="password">Password</label>
                                </div>

                                <!-- <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p><a id="forgotPasswordBtn" href="" style="color:white">Forgot password?</a></p>
                                </div> -->

                            </form>    

                            <div class="text-center">
                                <button id="logInBtn" class="login-btn btn blue-gradient btn" onkeypress="handle(event)">Log In</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div id="forgotPasswordDiv" style="display:none" class="animated">
                
                <div id="forgotPassword" class="text-center white-text mx-5" >
                    
                    <div class="card" style="width:100%">
                        
                        <div class="card-body">
                            
                            <div>
                                <h2 style="text-align:left" class="title">Forgot Password</h2>
                                
                                <form style="width:400px;margin:auto" class="form-horizontal">

                                    <div class="md-form">
                                        <input type="text" id="forgotEmail" class="form-control" autocomplete="off" onkeypress="handle(event)" name="forgotEmail">
                                        <label for="forgotEmail">Email</label>
                                    </div>

                                    <section class="text-center" style="margin-bottom:10px">
                                        <span class="text-center">OR</span>
                                    </section>

                                    <div class="md-form" style="margin-top:0">
                                        <input type="text" id="forgotUserName" class="form-control" autocomplete="off" onkeypress="handle(event)">
                                        <label for="forgotUserName" name="forgotUserName">User Name</label>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <p><a id="rememberedPassword" href="index.php?login=1" style="color:white" >I remembered my password</a></p>
                                    </div>

                                    <button id="resetPasswordBtn" style="margin:10px 0 25px 0;text-transform:none" name="submit" type="submit" class="login-btn btn blue-gradient">RESET PASSWORD</button><br>
                                            
                                    <input type="hidden" name="subStep" value="1" />
                                </form>
                            </div>
                            

                        </div>
                    </div>

                </div>
            </div>

            <div id="messageDiv" style="display:none" class="animated">

                <div id="message" class="text-center white-text mx-5 wow fadeIn animated" style="max-width: 500px">

                    <div class="card" style="width:100%">
                        
                        <div class="card-body">

                            <div>
                                <h2 style="text-align:left" class="title">Password Recovery</h2>

                                <div id="error_message" class="form-group animated" style="width:100%;display:none">
                                    <div style="margin-top:20px; background-color:#e84c3d; color:white; padding:10px 20px" >
                                        <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>&nbsp&nbspThe username or email you entered was not found.</p>
                                    </div>
                                
                                    <p style="margin-top:20px"><a id="tryAgainLink">Click here to try again</a></p>
                                </div>

                                <div id="success_message" class="form-group animated" style="width:100%;display:none">
                                    <div style="margin-top:20px; background-color:#bcdab0; color:#2a5f2b; padding:10px 20px">
                                        <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-check"></i>&nbsp&nbspAn Email has been sent to you with instructions on how to reset your password.</p>
                                    </div>
                                
                                    <p style="margin-top:20px"><a id="returnToLoginLink">Return to login screen</a></p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/shader.js"></script>

<script>

    snow = new Shader(holder, {
        
        depthTest: false,

        texture: snowflake,

        uniforms: {
            worldSize: {type: 'vec3', value: [ 0, 0, 0 ] },
            gravity: {type: 'float', value: 100 },
            wind:{type: 'float', value: 0 },
        },

        buffers: {
            size: {size: 1, data: [] },
            rotation: {size: 3, data: [] },
            speed: {size: 3, data: [] },
        },

        vertex: `
            precision highp float;

            attribute vec4 a_position;
            attribute vec4 a_color;
            attribute vec3 a_rotation;
            attribute vec3 a_speed;
            attribute float a_size;

            uniform float u_time;
            uniform vec2 u_mousemove;
            uniform vec2 u_resolution;
            uniform mat4 u_projection;
            uniform vec3 u_worldSize;
            uniform float u_gravity;
            uniform float u_wind;

            varying vec4 v_color;
            varying float v_rotation;

            void main() {

                v_color = a_color;
                v_rotation = a_rotation.x + u_time * a_rotation.y;

                vec3 pos = a_position.xyz;

                pos.x = mod(pos.x + u_time + u_wind * a_speed.x, u_worldSize.x * 2.0) - u_worldSize.x;
                pos.y = mod(pos.y - u_time * a_speed.y * u_gravity, u_worldSize.y * 2.0) - u_worldSize.y;

                pos.x += sin(u_time * a_speed.z) * a_rotation.z;
                pos.z += cos(u_time * a_speed.z) * a_rotation.z;

                gl_Position = u_projection * vec4( pos.xyz, a_position.w );
                gl_PointSize = ( a_size / gl_Position.w ) * 100.0;
            }`
        ,

        fragment: `
            precision highp float;

            uniform sampler2D u_texture;

            varying vec4 v_color;
            varying float v_rotation;

            void main() {

                vec2 rotated = vec2(
                cos(v_rotation) * (gl_PointCoord.x - 0.5) + sin(v_rotation) * (gl_PointCoord.y - 0.5) + 0.5,
                cos(v_rotation) * (gl_PointCoord.y - 0.5) - sin(v_rotation) * (gl_PointCoord.x - 0.5) + 0.5
                );

                vec4 snowflake = texture2D(u_texture, rotated);

                gl_FragColor = vec4(snowflake.rgb, snowflake.a * v_color.a);

            }`
        ,

        onResize( w, h, dpi ) {
            
            var position = [], color = [], size = [], rotation = [], speed = []

            // z in range from -80 to 80, camera distance is 100
            // max height at z of -80 is 110
            var height = 110;
            var width = w / h * height;
            var depth = 80;

            Array.from( { length: w / h * count }, snowflake =>  {

                position.push(
                    -width + Math.random() * width * 2,
                    -height + Math.random() * height * 2,
                    Math.random() * depth * 2
                );

                speed.push(// 0, 0, 0 )
                    .6 + Math.random(),
                    .6 + Math.random(),
                    Math.random() * 10
                ); // x, y, sinusoid

                rotation.push(
                    Math.random() * 2 * Math.PI,
                    Math.random() * 20,
                    Math.random() * 10
                ); // angle, speed, sinusoid

                color.push(
                    1,
                    1,
                    1,
                    0.1 + Math.random() * 0.2
                );

                size.push(
                    5 * Math.random() * 5 * ( h * dpi / 1000 )
                );

            });

            this.uniforms.worldSize = [ width, height, depth ]

            this.buffers.position = position
            this.buffers.color = color
            this.buffers.rotation = rotation
            this.buffers.size = size
            this.buffers.speed = speed
        },

        onUpdate( delta ) {
            wind.force += ( wind.target - wind.force ) * wind.easing
            wind.current += wind.force * ( delta * 0.2 )
            this.uniforms.wind = wind.current
        },
    });

    $('#logInBtn').click(function() {
   
        var password = $('#password').val();
        var email = $('#email').val();
        var userName = $('#userName').val();
        // if (!password || !email) return;
        if (!userName || !password) return;
        var data = {
            password: password,
            email: email,
            userName: userName
        };

        $.ajax({
            data: data,
            type: "POST",
            dataType:'json',
            url: "check_login.php",
            success: function(data) {
                if (data.success) {
                    $('.snow').addClass('fadeOut').removeClass('fadeIn');
                    setTimeout(function() {
                        location.replace('index.php');
                    }, 1000);
                } else if (!data.success) {
                    $('#login_error_message').text(data.error_message);
                    $('#login_error').addClass('fadeIn').show();
                }
            }
        });
    });

    $('#forgotPasswordBtn').click(function(e) {
        e.preventDefault();
        $('#loginDiv').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            $('#loginDiv').hide();
            $('#forgotPasswordDiv').removeClass('fadeOut').show().addClass('fadeIn');
            $('#login_error').hide();
        }, 1000);
    });

    $('#rememberedPassword').click(function(e) {
        e.preventDefault();
        $('#forgotPasswordDiv').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            $('#forgotPasswordDiv').hide();
            $('#loginDiv').removeClass('fadeOut').show().addClass('fadeIn');
        }, 1000);
    });

    $('#tryAgainLink').click(function() {
        $('#messageDiv').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            $('#messageDiv').hide();
            $('#login_error').hide();
            $('#error_message').hide();
            $('#forgotPasswordDiv').removeClass('fadeOut').show().addClass('fadeIn');
        }, 1000);
    });

    $('#returnToLoginLink').click(function() {
        $('#messageDiv').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            $('#messageDiv').hide();
            $('#login_error').hide();
            $('#error_message').hide();
            $('#loginDiv').removeClass('fadeOut').show().addClass('fadeIn');
        }, 1000);
    });

    $('#resetPasswordBtn').click(function(e) {
        e.preventDefault();
        $that = $(this);
        var userName = $('#forgotUserName').val();
        var email = $('#forgotEmail').val();
        if (!userName && !email) {
            return;
        }
        var data = {
            userName: userName,
            email: email
        };
        $.ajax({
            data: data,
            type: "POST",
            dataType:'json',
            url: "forgot_password.php",
            beforeSend: function () {
                $that.html('working...');
            },
            success: function(data) {
                if (!data.success) {
                    $('#forgotPasswordDiv').addClass('fadeOut').removeClass('fadeIn');
                    setTimeout(function() {
                        $('#forgotPasswordDiv').hide();
                        $('#login_error').hide();
                        $('#messageDiv').removeClass('fadeOut').show().addClass('fadeIn');
                        $('#error_message').show();
                        $('#success_message').hide();
                        $that.html('RESET PASSWORD');
                    }, 1000);
                    return;
                } else if (data.success) {
                    $('#forgotPasswordDiv').addClass('fadeOut').removeClass('fadeIn');
                    setTimeout(function() {
                        $('#forgotPasswordDiv').hide();
                        $('#login_error').hide();
                        $('#messageDiv').removeClass('fadeOut').show().addClass('fadeIn');
                        $('#error_message').hide();
                        $('#success_message').show();
                        $that.html('RESET PASSWORD');
                    }, 1000);
                    return;
                }
            }
        });
    });

    function showLogin() {
        $('#logoDiv').removeClass('fadeIn').addClass('fadeOut');
        $('#logoDiv').one('animationend',function() {
            $('#logoDiv').hide();
            $('#loginDiv').show().removeClass('fadeOut').addClass('fadeIn');
        });
    }

    function handle(e) {
        if(e.keyCode === 13){
            e.preventDefault(); 
            $('#logInBtn')[0].click();
        }
    }

</script>

</body>

</html>
