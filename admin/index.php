
<?php 

  require_once "libs/config.php";
  require_once "libs/function.php";

  if( isset($_SESSION['email']) || isset($_SESSION['uname']) ) {
    header("location:dashboard.php");
  }


 ?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="css/app.v1.css" type="text/css" />
   
</head>

<body class="">
    <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
        <div class="container aside-xl"> <a class="navbar-brand block" href="index.html">Admin Panel</a>
            <section class="m-b-lg">
                <header class="wrapper text-center"> <strong>Sign in to get in touch</strong> </header>

                 <?php 

        if( isset($_POST['submit']) ){
          $email_or_uname = $_POST['ue'];
          $pass = $_POST['pass'];

          if( empty($email_or_uname) || empty($pass) ){
             $message = "<p class='alert alert-danger'> Filed must not be Empty !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
           }
                    
                   
          else{

            $sql = "SELECT * FROM users WHERE uname='$email_or_uname' OR  email='$email_or_uname' ";
            $data = $conn -> query($sql);

            $user_num = $data -> num_rows ;



            
            if( $user_num == 1 ){
              $user_login_data = $data -> fetch_assoc();

                if (password_verify($pass, $user_login_data['pass']) == false ) {

                 $message = "<p class='alert alert-danger'> Incorrect Password !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
              
               
              }else{
                $_SESSION['uname'] = $user_login_data['uname'];
                $_SESSION['name'] = $user_login_data['name'];
                $_SESSION['email'] = $user_login_data['email'];
                $_SESSION['pic'] = $user_login_data['photo'];
                
                
                

                header("location:dashboard.php");

              }
      
            }





            else{
               $message = "<p class='alert alert-danger'> Wrong Username or E-mail !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
             }
           }

          }





       ?>


       <div class="mass">
      <?php 

        if (isset($message)) {
          echo $message;
        }

       ?>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="list-group">
                        <div class="list-group-item">
                            <input name="ue" type="text" placeholder="Email / Username" class="form-control no-border"> </div>
                        <div class="list-group-item">
                            <input name="pass" type="password" placeholder="Password" class="form-control no-border"> </div>
                    </div>
                    <button name="submit" type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                    <div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
                    <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Do not have an account?</small></p> <a href="signup.php" class="btn btn-lg btn-default btn-block">Create an account</a> </form>
            </section>
        </div>
    </section>
    
    <!-- / footer -->
    <!-- Bootstrap -->
    <!-- App -->
    <script src="js/app.v1.js"></script>
    <script src="js/app.plugin.js"></script>
</body>

</html>
