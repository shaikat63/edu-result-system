<?php 

  require_once "libs/config.php";
  require_once "libs/function.php";


 ?>

<!DOCTYPE html>
<html lang="en" class=" ">

<head>
    <meta charset="utf-8" />
    <title>Admin Registration</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="css/app.v1.css" type="text/css" />
    
</head>

<body class="">
    <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
        <div class="container aside-xl"> <a class="navbar-brand block text-success" href="index.php">Admin panel</a>
            <section class="m-b-lg">
                <header class="wrapper text-center"> <strong>Sign up to find interesting thing</strong> </header>

                <?php 



     if (isset($_POST['submit'])) {

          $name = $_POST['name'];

          //User Name Manage
          $uname = $_POST['uname'];
          $username_check = userNameCheck($uname, $conn);


          //Password Management
          $email = $_POST['email'];
          $email_check = emailCheck($email, $conn);


          //Password Management
          $pass = $_POST['pass'];
          $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

          //File Management
         $img_name = $_FILES['pic']['name'];
         $img_tname = $_FILES['pic']['tmp_name'];


        $unique_name = time().rand().$img_name;
        $extention_array = explode('.', $unique_name);
        $extention_name = end($extention_array);
        $enc_name = md5($unique_name).'.'.strtolower($extention_name);
          

            if ( isset($_POST['check']) AND $_POST['check'] == 'agree' ) {
                $allow = true;
            }else{
                $allow = false;
            }
           

            if (empty($name) || empty($uname) ||  empty($email) || empty($img_name) || empty($pass) ) {
             $message = "<p class='alert alert-danger'> Field must mot be Empty !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
          }else if ( $allow == false) {
              $message = "<p class='alert alert-danger'> You must check this button !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
          }
          else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
             
              $message = "<p class='alert alert-danger'> Invalid E-mail !! <button class='close' data-dismiss='alert'>&times;</button> </p>";
                
               }


             else if ( $username_check == false) {
                 $message = "<p class='alert alert-danger'>User Name Already Exists !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
               }  
                  else if ( $email_check == false) {
                 $message = "<p class='alert alert-danger'>E-mail Already Exists !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
               }

           elseif (in_array($extention_name, ['jpg','JPG','PNG','JPEG','png','jpeg','GIF','gif']) == false) {
                   

                    $message = "<p class='alert alert-danger'>Invalid image Formet !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
                 }      

          else{




           $sql = "INSERT INTO users(name, uname, email, pass, photo, status) VALUES('$name','$uname','$email','$hash_pass','$enc_name', 'active')";
              $conn -> query($sql);
              move_uploaded_file($img_tname, 'users_photo/'.$enc_name);

               $message = "<p class='alert alert-success'> Data stable !! <button class='close' data-dismiss='alert'>&times;</button> </p>";


          }
        }




   ?>


<div class="mess">
  <?php 

    if (isset($message)) {
      echo $message;
    }

   ?>
</div>


                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="list-group">
                        <div class="list-group-item">
                            <input name="name" placeholder="Name" type="text" class="form-control no-border"> </div>
                        <div class="list-group-item">
                            <input name="uname" placeholder="Username" type="text" class="form-control no-border"> </div>
                        <div class="list-group-item">
                            <input name="email" type="text" placeholder="Email" class="form-control no-border"> </div>
                         <div class="list-group-item">
                            <input name="pass" type="password" placeholder="Password" class="form-control no-border"> </div>
                         <div class="list-group-item">
                            <input name="pic" type="file" class="form-control no-border"> </div>
                        
                    </div>
                    <div class="checkbox m-b">
                        <label>
                            <input name="check" value="agree" type="checkbox"> Agree the <a href="#">terms and policy</a> </label>
                    </div>
                    <button name="submit" type="submit" class="btn btn-lg btn-primary btn-block">Sign up</button>
                    <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Already have an account?</small></p> <a href="index.php" class="btn btn-lg btn-default btn-block">Sign in</a> </form>
            </section>
        </div>
    </section>
    <!-- footer -->
    <footer id="footer">
        <div class="text-center padder clearfix">
            <p> <small>Web app framework base on Bootstrap<br>&copy; 2020</small> </p>
        </div>
    </footer>
    <!-- / footer -->
    <!-- Bootstrap -->
    <!-- App -->
    <script src="js/app.v1.js"></script>
    <script src="js/app.plugin.js"></script>
</body>

</html>