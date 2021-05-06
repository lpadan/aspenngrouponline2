$(document).ready(function() {      

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

    new WOW().init();

    $('[data-toggle="tooltip"]').tooltip();
    $(".button-collapse").sideNav();

    $('#logout').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "session_unset.php",
            success: function() {
                location.reload();
            }
        });
    });

    $('#changePasswordLink').click(function(){
        
        $('#changePasswordDiv').show().removeClass('fadeOut').addClass('fadeIn');
    });

    $('#changePasswordBtn').click(function() {
        alert("change password");
        return;
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
        if (!password1 || !password2) return;
        var data = {
            newPassword: password1,
        };

        $.ajax({
            data: data,
            type: "POST",
            dataType:'json',
            url: "change_password.php",
            success: function(data) {
                if (data.success) {
                    
                } else if (!data.success) {
                    $('#login_error_message').text(data.error_message);
                    $('#login_error').addClass('fadeIn').show();
                }
            }
        });
    });

    $('a[data-type="projecthome"]').click(function() {
        snow = undefined;
        $('canvas').remove();
        $('.snow').hide();
        var folderName = $(this).data('foldername');
        var projectId = $(this).data('projectid');

        // TEMP CODE
        // if (projectId == 1 || projectId == 3) {
        //     folderName = 'sommetBlancReservations';
        //     projectId = 5;
        // }

        $('#sidenav-overlay').remove();
        $('#main').removeClass('fadeIn').addClass('fadeOut');
        $('#main').one('animationend',function() { // one time event handler for animation end
            $.ajax({
                type: "GET",
                url: "projects/" + folderName + "/homePage.php?id=" + projectId,
                error: function(xhr) {
                    if (xhr.status == 419) {
                        alert("You have been logged out after a period of inactivity.\nPlease login again.");
                        location.reload();
                    }
                },
                success: function(html) {
                    $('.snow').css('background-image','none');
                    $('#main').html(html);
                    $('#main').removeClass('fadeOut').addClass('fadeIn');
                    // projectData is loaded into a script tag in projectHomePage.php.
                    //sessionStorage.setItem('projectData',JSON.stringify(projectData));
                }
            });
        });
    });

    $('a[data-type="imagegalleryhome"]').click(function(e) {
            e.preventDefault();
            snow = undefined;
            $('canvas').remove();
            $('.snow').hide();
            var filePath = $(this).data('filepath');
            $('#sidenav-overlay').remove();
            $('#main').removeClass('fadeIn').addClass('fadeOut');
            $('#main').one('animationend',function() { // one time event handler for animation end
                $.ajax({
                    type: "GET",
                    url: filePath,
                    error: function(xhr) {
                        if (xhr.status == 419) {
                            alert("You have been logged out after a period of inactivity.\nPlease login again.");
                            location.reload();
                        }
                    },
                    success: function(html) {
                        $('.snow').css('background-image','none');
                        $('#main').html(html);
                        $('#main').removeClass('fadeOut').addClass('fadeIn');
                    }
                });
            });
    });

    $('a[data-type="marketdatahome"]').click(function(e) {
            
            snow = undefined;
            $('canvas').remove();
            $('.snow').hide();
            var id = $(this).data('id');
            $('#sidenav-overlay').remove();
            //$('#main').removeClass('fadeIn').addClass('fadeOut');
            //$('#main').one('animationend',function() { // one time event handler for animation end
                $.ajax({
                    type: "GET",
                    url: "ajax/marketDataHomePage.php?id=" + id,
                    before: $('#main').html('<div id="loader">LOADING...</div>'),
                    error: function(xhr) {
                        if (xhr.status == 419) {
                            alert("You have been logged out after a period of inactivity.\nPlease login again.");
                            location.reload();
                        }
                    },
                    success: function(html) {
                        $('.snow').css('background-image','none');
                        $('#main').html(html);
                        $('#main').removeClass('fadeOut').addClass('fadeIn');
                    }
                });
            //});
    });

    $(document).on('click','[data-gallery]', function (event) {
        // necessary to hide sidebar when image gallery is active
        $('#main').removeClass('fadeIn');
    });

    $(document).on('click','a[data-type="data"]',function() {
        $.ajax({
            type: "GET",
            url: 'ajax/dataHomePage.php',
            error: function(xhr) {
                if (xhr.status == 419) {
                    alert("You have been logged out after a period of inactivity.\nPlease login again.");
                    location.reload();
                }
            },
            success: function(html) {
                $('#page_body').css({'background-image':'none','padding-top':'100px'});
                $('#page_body_header').html(html);
                $('#page_body_content').html('');
            }
        });
    });

    $(document).on('change','#spreadsheetSelect',function() {
        var spreadsheetId = $(this).val();
        $('#page_body_content').html('<div id="loader">Working...</div>');
        $.ajax({
            type: "GET",
            url: 'ajax/getSheetNames.php?googleId=' + spreadsheetId,
            dataType: 'json',
            error: function(xhr) {
                if (xhr.status == 419) {
                    alert("You have been logged out after a period of inactivity.\nPlease login again.");
                    location.reload();
                }
            },
            success: function(data) {
                if (data.success) {
                    var html = '';
                    var sheetNames = data.sheetNames;
                    for (var i = 0; i < sheetNames.length; i++) {
                        html += "<option value='" + sheetNames[i] + "'>" + sheetNames[i] + "</option>";
                    }
                } else {
                    alert(data.errorMessage);
                    $('#page_body_content').html('');
                    return;
                }
                $('#page_body_content').html('');
                $('#sheetSelect').html(html).materialSelect();
            }
        });
    });

    $(document).on('click','#getDocuments',function() {
        var folderId = $('#documentSelect').val();
        if (!folderId) return;
        $('#documentsTitle').html('');
        $('#page_body_content').html('<div id="loader">LOADING...</div>');
        var html = '<iframe src="https://drive.google.com/embeddedfolderview?id=';
        html += folderId + '#grid" style="width:100%; height:600px; border:0;"></iframe>';
        $('#page_body_content').html(html);
    });

    $(document).on('click','#getSchedule',function() {
        var sheetName = $('#scheduleSelect').val();
        if (!sheetName) return;
        $('#scheduleTitle').html('');

        if($('#scheduleIncomplete').is(":checked")) {
            var incomplete = 'true';
        } else {
            var incomplete = 'false';
        }

        if($('#scheduleCritical').is(":checked")) {
            var critical = 'true';
        } else {
            var critical = 'false';
        }        

        $('#page_body_content').html('<div id="loader">LOADING...</div>');
         $.ajax({
            type: "GET",
            url: 'ajax/getScheduleData.php?sheetName=' + sheetName + '&incomplete=' + incomplete + '&critical=' + critical,
            error: function(xhr) {
                if (xhr.status == 419) {
                    alert("You have been logged out after a period of inactivity.\nPlease login again.");
                    location.reload();
                }
            },
            success: function(html) {
                $('#page_body_content').html(html);
                $('#scheduleTitle').html("&nbsp;-&nbsp;" + sheetName);
            }
        });
    });

    $(document).on('click','#getReportData',function() {
        $('#tableSearch').val('');
        $('#reportTitle').html('');
        var spreadsheetId = $('#spreadsheetSelect').val();
        var sheetName = $('#sheetSelect').val();
        if (!sheetName) return;
        $('#page_body_content').html('<div id="loader">LOADING...</div>');
         $.ajax({
            dataType:'html',
            type: "GET",
            url: 'ajax/getReportData.php?spreadsheetId=' + spreadsheetId + '&sheetName=' + sheetName,
            error: function(xhr) {
                if (xhr.status == 419) {
                    alert("You have been logged out after a period of inactivity.\nPlease login again.");
                    location.reload();
                }
            },
            success: function(html) {
                $('#page_body_content').html(html);
                $('#reportTitle').html("&nbsp;-&nbsp;" + sheetName);
            }
        });
    });

    $(document).on('click','#getProjectData',function() {
        $('#projectDataTitle').html('');
        var sheetName = $('#projectSelect').val();
        if (!sheetName) return;

        $('#page_body_content').html('<div id="loader">LOADING...</div>');
         $.ajax({
            type: "GET",
            url: 'ajax/getMarketData.php?sheetName=' + sheetName,
            error: function(xhr) {
                if (xhr.status == 419) {
                    alert("You have been logged out after a period of inactivity.\nPlease login again.");
                    location.reload();
                }
            },
            success: function(html) {
                $('#projectDataTitle').html("&nbsp;-&nbsp;" + sheetName);
                $('#page_body_content').html(html);
                $('#page_body').css({'overflow-y':'scroll'});
            }
        });
    });

    $('#container').on('click','a[data-type="projectmenu"]',function() {
            $('#page_body').css({'background-image':'none','padding-top':'100px'});
            $('#page_body_header').html('');
            $('#page_body_content').html('<div id="loader">LOADING...</div>');
            var fileName = $(this).data('filename');
            var projectData = JSON.parse(sessionStorage.getItem('projectData'));
            var projectFolderName = projectData.projectFolderName;
            
            if (fileName.substring(0,4) == 'ajax') url = fileName + "HomePage.php";
            else url = "projects/" + projectFolderName + "/" + fileName + "/index.php?title=" + fileName;

            $.ajax({
                type: "GET",
                url: url,
                error: function(xhr) {
                    if (xhr.status == 419) {
                        alert("You have been logged out after a period of inactivity.\nPlease login again.");
                        location.reload();
                    }
                },
                success: function(html) {
                    $('#page_body').removeClass('page-body'); // the presence of this class screws up the image alignment, but need it there for the background-image
                    $('#page_body_header').html(html);
                    $('#page_body_content').html('');
                }
            });   
    });

    $('#unitFloorPlan').on('scroll', function() {
        var scrollTop = $(this).scrollTop();
        if(scrollTop + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            $('.down-arrow').hide();
            $('.up-arrow').show();
        } else if(scrollTop == 0) {
            $('.down-arrow').show();
            $('.up-arrow').hide();
        }
    });

});


    function handle(e) {
        if(e.keyCode === 13){
            e.preventDefault(); 
            $('#logInBtn')[0].click();
        }
    }

    function showLogin() {
        $('#logoDiv').removeClass('fadeIn').addClass('fadeOut');
        $('#logoDiv').one('animationend',function() {
            $('#logoDiv').hide();
            $('#loginDiv').show().removeClass('fadeOut').addClass('fadeIn');
        });
    }
    
    function showDashboard() {
        $('#login').addClass('fadeOut').removeClass('fadeIn');
        setTimeout(function() {
            window.location.assign('dashboard.html');
         }, 1500);   
    }