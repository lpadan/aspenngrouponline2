<?php
// require_once('../private/initializeBeforeLogin.php');
// $db = db_connect();


// $show = 'authorize_account_form'; //which form step to show by default

// if (isset($_POST['subStep']) && !isset($_GET['a'])) {

//     switch($_POST['subStep']) {

//         case 2:
//             //we are submitting a new password
//             if (strcmp($_POST['pw0'],$_POST['pw1']) != 0 || trim($_POST['pw0']) == '')
//             {
//                 $error = true;
//                 $show = 'authorize_account_form';
//             } else {
//                 $error = false;
//                 $show = 'recover_success';
//                 updateUserPassword($_POST['user_id'],$_POST['pw0'],$_POST['key'], $db);
//             }
//         break;
//     }
// } else if (isset($_GET['a']) && $_GET['a'] == 'recover' && $_GET['email'] != "") {
//     $result = checkEmailKey($_GET['email'],base64_decode($_GET['u']),$db);
//     if ($result == false) {
//         $error = true;
//         $show = 'invalidKey';
//     } elseif ($result['status'] == true) {
//         $error = false;
//         $show = 'recoverForm';
//         $security_user = $result['user_id'];
//     }
// } else if (isset($_GET['a']) && $_GET['a'] == 'new' && $_GET['email'] != "") {
//     $result = checkEmailKey($_GET['email'],base64_decode($_GET['u']),$db);
//     if ($result == false) {
//         $error = true;
//         $show = 'invalidKey';
//     } elseif ($result['status'] == true) {
//         $error = false;
//         $show = 'authorizeAccountForm';
//         $security_user = $result['user_id'];
//         $userId = $result['user_id'];
//         $user = User::find_by_id($userId);
//     }
// } else {
//     header("location:login.php");
// }

$show = 'recover_success';

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

    <!-- Font Awesome CSS -->
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

    <style>


        canvas { 
            display: block; 
        }

        .snow { 
            position: absolute; left: 0; top: 0; right: 0; bottom: 0; 
        }


        .card {
            background-color: rgba(0, 0, 0, 0.4 );
            width:450px;
        }

        .card .card-body h2 {
            font-weight: 300
        }

        #container {
            background:url('img/aspens_blackandwhite.png');
            background-repeat:no-repeat;
            background-size:cover;
            width: 100vw;
            height: 100vh;
        }

        #logo {
            background-color:rgba(0,0,0,.4);
            border-radius:.25rem;

        }

        html,body,header,.view {
            height: 100%;
            /*cursor:pointer;*/
        }

        #login {
            display:none;
        }

        .login-btn {
            padding:7px 20px;
        }

        

        .md-form label {
            color: #ffffff;
        }
        
        h6 {
            line-height: 1.7;
        }

        .md-form input[type=text]:focus:not([readonly]),
        .md-form input[type=password]:focus:not([readonly]) {
            /*border-bottom: 1px solid #3fa6e3!important;*/
            border-bottom: 1px solid white!important;
            /*box-shadow: 0 1px 0 0 #3fa6e3!important;*/
            box-shadow: 0 1px 0 0 white!important;
        }
        .md-form input[type=text]:focus:not([readonly])+label,
        .md-form input[type=password]:focus:not([readonly])+label {
            /*color: #3fa6e3!important;*/
            color: white!important;
        }

        .md-form .form-control {
            /*color: #fff;*/
            color:white!important;
        }
    </style>
</head>

<body>

<div id="container" class="view">

    <div class="snow" count="2000">

        <div class="mask d-flex justify-content-center align-items-center">

            <div id="recoverFormDiv" class="animated slow">
                <div class="text-center white-text mx-5 wow fadeIn animated slow" data-wow-delay=".8s">
                    
                    <div class="card" style="width:100%">
                        
                        <div class="card-body">

                            <?php

                            switch($show) {
                                
                                case 'authorizeAccountForm':?>

                                    <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                                        <div class="form-block center-block">
                                            <h2 class="title">Create New Password</h2>
                                            <hr>


                                            <?php
                                                if ($error == true) {
                                                    echo'<div id = "login_error" class = "form-group" >';
                                                        echo'<div style = "background-color:#e84c3d; color:white; margin:0px 20px; padding:10px 20px" >';
                                                            echo'<p style = "display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>&nbspPasswords did not match.</p>';
                                                        echo'</div>';
                                                    echo'</div>';
                                                } else {
                                                    echo '<p>Welcome ' . $user->first_name . '&nbsp, please enter a password for your account.</p>';
                                                }
                                            ?>


                                            <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">

                                                <div style="width:400px;margin:auto" class="form-horizontal" >

                                                    <div class="md-form">
                                                        <input type="text" id="pw0" class="form-control" autocomplete="off" onkeypress="handle(event)" name="pw0">
                                                        <label for="pw0">New Password</label>
                                                    </div>

                                                    <div class="md-form" style="margin-top:0">
                                                        <input id="pw1" type="text" id="userName" class="form-control" autocomplete="off" onkeypress="handle(event)">
                                                        <label for="pw1" name="pw1">Confirm Password</label>
                                                    </div>

                                                    <button id="submitPasswordBtn" style="margin:10px 0 25px 0;text-transform:none" class="login-btn btn blue-gradient">SUBMIT</button>
                                                    <!-- <button name="submit" type="submit" class="btn btn-group btn-default btn-sm">Submit</button> -->

                                                    <br>
                                                            
                                                </div>

                                                <input type="hidden" name="subStep" value="2" />
                                                <input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
                                                <input type="hidden" name="key" value="<?php echo $_GET['email']; ?>" />
                                        
                                            </form>

                                        </div>
                                    </div> <?php
                                break;

                                case 'recoverForm': 
                                    if (!isset($security_user) || $security_user == '') $security_user = $_POST['user_id'];
                                    $user = User::find_by_id($security_user); ?>
                            
                                        <div>
                                            <h2 style="text-align:left" class="title">Password Reset</h2>
                                            <hr style="border:1px solid white">

                                            <div id="welcome_message" class='error'>
                                                <?php echo '<p>Welcome back ' . $user->first_name . '&nbsp, please enter your new password.</p>';?>
                                            </div>

                                            <div id="no_match_message" class="error form-group animated" style="width:100%;display:none">
                                                <div style="margin-top:20px; background-color:#e84c3d; color:white; padding:10px 20px" >
                                                    <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>&nbsp&nbspPasswords did not match.</p>
                                                </div>
                                            </div>


                                            <div style="width:400px;margin:auto" class="form-horizontal" >

                                                <div class="md-form">
                                                    <input type="text" id="pw0" class="form-control" autocomplete="off" onkeypress="handle(event)" name="pw0">
                                                    <label for="pw0">New Password</label>
                                                </div>

                                                <div class="md-form" style="margin-top:0">
                                                    <input id="pw1" type="text" id="userName" class="form-control" autocomplete="off" onkeypress="handle(event)">
                                                    <label for="pw1" name="pw1">Confirm Password</label>
                                                </div>

                                                <button id="submitPasswordBtn" style="margin:10px 0 25px 0;text-transform:none" class="login-btn btn blue-gradient">SUBMIT</button><br>
                                                        
                                            </div>
                                        </div>
                                

                                    <?php
                                break;

                                case 'invalidKey': ?>
                                    
                                    <div id="invalidKeyDiv" style="max-width:600px">
                                        <h2 style="text-align:left" class="title">Password Reset</h2>
                                        <hr style="border:1px solid white">

                                        <div class="error form-group animated" style="width:100%">
                                            <div style="margin-top:20px;text-align:left;background-color:#e84c3d; color:white; padding:10px 20px" >
                                                <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>
                                                    &nbsp;&nbsp;The link that brought you to this page is no longer valid.
                                                </p>
                                                <hr style="background-color:white;margin:10px 0">
                                                <p style="margin-bottom:0">The link may have been used previously, or it has expired.</p>
                                                <p style="margin-bottom:10px">Password reset links are valid for 3 days, and may only be used once. </p>
                                            </div>
                                        </div>

                                    <?php
                                break;

                                case 'recover_success': ?>
                            
                                    <div>
                                        <h2 style="text-align:left" class="title">Account Setup Complete</h2>
                                        <!-- <hr style="border:1px solid white"> -->

                                        <div class="alert alert-success form-group animated" style="margin-top:20px">
                                            <p style="margin:0"><i style="float:left" class="fas fa-check-circle fa-2x"></i><span style="display:inline-block;margin-top:5px">&nbsp&nbspCongratulations! your account is ready for use.</span></p>
                                        </div>

                                        <div class="text-center">
                                            <button id="logInBtn" class="login-btn btn blue-gradient btn">Log In</button>
                                        </div>

                                    </div>


                                    <?php
                                break;

                            } ?>

                            

                        </div>
                    </div>
                </div>
            </div>


            <div id="successMessageDiv" class="fadeIn animated slow" style="display:none">
                
                <div class="card" style="width:100%">
                    
                    <div class="card-body">

                        <div id="successMessage" class="text-center white-text mx-5 animated">
                                        
                            <h2 style="text-align:left" class="title">Password Reset</h2>
                            <hr style="border:1px solid white">
                            <div style="margin-top:20px; background-color:#bcdab0; color:#2a5f2b; padding:10px 20px" >
                                <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-check"></i>&nbsp;&nbsp;Congratulations! Your password has been reset successfully.</p>
                            </div>
                            <p style="margin-top:20px"><a id="returnToLoginLink">Return to login screen</a></p>
                        
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/shader.js"></script>

<script>

$(document).ready(() => {

    new WOW().init();

    var snow = new Shader(holder, {
        
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

    $('#submitPasswordBtn').click(function() {

        var pw0 = $('#pw0').val();
        var pw1 = $('#pw1').val();
        $that = $(this);

        if (!pw0 || !pw1) return false;
        
        if (pw0 !== pw1) {
            $('.error').hide();
            $('#no_match_message').removeClass('fadeOut').show().addClass('fadeIn');
            return;
        }  else {

            var data = {
                password:pw0,
                //userId: <?php //echo base64_decode($_GET['u'])?>,
                //key:'<?php //echo $_GET['email']?>'
            };

            $.ajax({
                data: data,
                type: "POST",
                dataType:'json',
                url: "change_password.php",
                beforeSend: function () {
                    $that.html('working...');
                },
                success: function(data) {
                    if (!data.success) {
                        $that.html("SUBMIT");
                    } else if (data.success) {
                        $('#recoverFormDiv').addClass('fadeOut').removeClass('fadeIn');
                        setTimeout(function() {
                            $('#recoverFormDiv').hide();
                            $('#successMessageDiv').removeClass('fadeOut').show().addClass('fadeIn');
                            $('.error').hide();
                            $that.html("SUBMIT");
                        }, 1500);
                    }
                }
            });
        }
    });

    $('#returnToLoginLink').click(function() {
        $('#successMessageDiv').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            window.location.assign('index.php');
        },1500);
    });

    $('#logInBtn').click(function() {
        location.assign('login.php?display=1');
    });

});

function handle(e) {
    if(e.keyCode === 13){
        e.preventDefault();
        $('#submitPasswordBtn')[0].click();
    }
}



    

</script>


</body>

</html>