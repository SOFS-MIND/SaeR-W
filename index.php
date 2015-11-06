<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sam ERP | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Sam</b>ERP</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="login_process.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Email/Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>
		<!-- /.social-auth-links --

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
	<script>
        $(document).ready(function(){
            
$('#login_form').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },

            messages: {
                username: {
                    required: "Username is required."
                },
                password: {
                    required: "Password is required."
                }
            },

            submitHandler: function (form)
            {
                 formData = {
				            'username'              : $('#username').val(),
				            'password'             : $('#password').val()
                            };
                            //console.log(formData);
                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : 'login_process.php', // the url where we want to POST
                                data        : formData, // our data object
                                dataType    : 'json', // what type of data do we expect back from the server
                                encode      : true
                            })
                                .done(function(data) {
                        // log data to the console so we can see
                                    console.log(data); 
                                  if(data.success == true)
                                   {
                                       
                                        window.location.href = "home.php";
                                   }
                                  if(data.error == true)
                                   {
                                       //alert("Enter valid username and passowrd.");
                                       $('#noty_msg').css("display","block");
                                   }
                                  if(data.error_otp == true){
                                	  $('#noty_msg').css("display","none");
                                	  $('#noty_otp_msg').css("display","block");
                                  }
                                });
            }
        });

 $('#login_form input').keypress(function (e) {
      if (e.which == 13) {
                if ($('#login_form').validate().form()) {
                   formData = {
				            'username'              : $('#username').val(),
				            'password'             : $('#password').val()
                            };
                            //console.log(formData);
                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : 'login_process.php', // the url where we want to POST
                                data        : formData, // our data object
                                dataType    : 'json', // what type of data do we expect back from the server
                                encode      : true
                            })
                                .done(function(data) {
                        // log data to the console so we can see
                                    console.log(data); 
                                  if(data.success == true)
                                   {
                                       
                                        window.location.href = "home.php";
                                   }
                                  if(data.error == true)
                                   {
                                       //alert("Enter valid username and passowrd.");
                                       $('.alert-error').removeClass("hide");
                                   }
                                });
                }
                return false;
            }
 });
        });
        </script>
  </body>
</html>
