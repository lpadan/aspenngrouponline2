<?php

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

$webcam1 = ROOT . '/projects/sommetBlancReservations/webCams/images/webcam1.jpg?';
$webcam2 = ROOT . '/projects/sommetBlancReservations/webCams/images/webcam2.jpg?2';
$weather = ROOT . '/projects/sommetBlancReservations/webCams/images/weather.jpg?2';

?>

<style>

    .overlay-container span.hover {
        color:white;
        background-color:#4e5b5e;
    }

    .overlay-container>a {
        text-decoration: none;
    }

    .overlay-container {
        display:inline-block;
        margin:10px 10px 5px 10px;
        max-width:300px;
        <?php 
        if ($containerWidth) {
            echo "width:" . $containerWidth . "px";
        }?>

    }

    @media (max-width:650px) {
        .overlay-container {
            display:inline-block!important;
            width:100%!important;
            margin:0 0 10px 0!important;
        }

        .tab-pane>div {
            padding:0;
        }
    }

    .overlay-hover {
        background-color:#4e5b5e;
        color:white;
    }

    .overlay-container span {
        text-align:center;
        text-transform:uppercase;
        color:#333;
        font-size:18px;
        background-color:#f2f2f2;
        border-color:#f3f3f3;
        display:block;
        width:100%;
        padding:17px 12px;
        white-space: nowrap;
        overflow-x:scroll;
    }

    img {
        max-width: 100%
    }

</style>

<div style="margin-top:90px">

    <div class="overlay-container">
        <a class="modal-btn btn waves-effect waves-light" data-toggle="modal" data-target="#webCamModal1">
            <img src="<?=$webcam1?>"><span class="">Webcam 1</span>
        </a>
    </div>

    <div class="overlay-container">
        <a class="modal-btn btn waves-effect waves-light" data-toggle="modal" data-target="#webCamModal2">
            <img src="<?=$webcam2?>"><span class="">Webcam 2</span>
        </a>
    </div>

    <div class="overlay-container">
        <a class="modal-btn btn waves-effect waves-light" data-toggle="modal" data-target="#weatherModal">
            <img src="<?=$weather?>"><span class="">Weather</span>
        </a>
    </div>

</div>

<script>


    $(".overlay-container").hover(function(){
        $(this).find('span').addClass('hover');
        }, function(){
            $(this).find('span').removeClass('hover');
    });

</script>

