<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Admin styles -->
    <!-- <link rel="stylesheet" href="css/mdb.admin.min.css"> -->

    <!-- Font Awesome CSS -->
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="css/animations.css" rel="stylesheet">


  <style>

    .skin-light .login-form,
    .skin-light .logout-form {
      max-width: 30rem;
      margin-right: auto;
      margin-left: auto;
    }

    .skin-light .logout-form {
      display: none;
    }

    .object-non-visible {
      opacity:0;
    }

    .form-block {
      border:1px solid #f1f1f1;
      width:630px;
      margin:auto;
      margin-top:70px;
      padding:20px;
      border-radius:10px;
      background-color:white;
    }

    body {
      background-color:#f1f1f1;
    }

    .main {
      background-color: white;
    }

  </style>

</head>

<body class="">


  <header>

      <div class="container-fluid" style="background-color: #333">

        <!-- Brand -->
        <a class="navbar-brand" href="" style="width:100%">
          <img src="img/ag-logo-blue-300.png" style="margin:auto;display:block">
        </a>

      </div>


  </header>


<div class="page-wrapper">

  <main class= "object-non-visible form-block" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
    
    <div class="container">


      <!--Grid row-->
      <div class="row d-flex justify-content-center">

        <!--Grid column-->
        <div style="width:100%">

            <!--Section: Login Form-->
            <section class="login-form">

                <h3 class="mb-0">Sign in</h3>
                <hr>


                <?php
                if (isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) {
                    echo'<div id="login_error" class="form-group" >';
                    echo'<div style = "background-color:#e84c3d; color:white; margin:0px 20px; padding:10px 20px" >';
                    echo'<p style="display:table-cell; height:40px; vertical-align:middle"><i class="fa fa-warning"></i>&nbsp&nbspAuthentication failed. &nbspYou entered an incorrect user name or password.</p>';
                    echo'</div>';
                    echo'</div>';
                }
                ?>

                <!-- <div id="login_error" class="form-group" >
                    <div style="margin-top:20px; background-color:#e84c3d; color:white; padding:10px 20px" >
                        <p style="display:table-cell; height:40px; vertical-align:middle"><i class = "fa fa-warning"></i>&nbsp&nbspAuthentication failed. &nbspYou entered an incorrect user name or password.</p>
                    </div>
                </div> -->

                <form id="login_form" action="check_login.php" method="POST" class="needs-validation" style="width:75%;margin:auto" novalidate autocomplete="off">

                    <div class="md-form md-outline">
                        <input type="email" name="login-email" id="login-email" class="form-control">
                        <label data-error="wrong" data-success="right" for="login-email">Your email</label>
                    </div>

                    <div class="md-form md-outline">
                        <input type="password" name="login-password" id="login-password" class="form-control">
                        <label data-error="wrong" data-success="right" for="login-password">Your password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <div class="form-check pl-0 mb-3">
                            <input type="checkbox" class="form-check-input filled-in" id="new">
                            <label class="form-check-label small text-uppercase card-link-secondary" for="new">Remember me</label>
                        </div>

                        <p><a href="forgot_password.php">Forgot password?</a></p>

                    </div>

                    <div class="text-center pb-2">

                        <button type="submit" class="btn btn-primary mb-4">Sign in</button>


                    </div>

                </form>

            </section>

        </div>

      </div>

    </div>
  </main>

</div>



  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- <script type="text/javascript" src="js/mdb.admin.min.js"></script> -->
  <script src="plugins/appear/jquery.appear.js"></script>

  <script type="text/javascript">

  $(document).ready(function() {

    // Animations
    //-----------------------------------------------
    if ($("[data-animation-effect]").length>0) {
      $("[data-animation-effect]").each(function() {
        var delay = 0;
        var item = $(this),
        animationEffect = item.attr("data-animation-effect");
        item.appear(function() {
          if(item.attr("data-effect-delay")) item.css("effect-delay", delay + "ms");
          setTimeout(function() {
            item.addClass('animated object-visible ' + animationEffect);

          }, item.attr("data-effect-delay"));
        }, {accX: 0, accY: -130});
      });
    };

  }); // End document ready

</script>
</body>

</html>