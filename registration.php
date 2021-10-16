<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include_once "includes/functions_mysqli.php"; ?>
 <?php  include_once "includes/functions_pdo.php"; ?>
 <?php  include_once "includes/db_pdo.php"; ?>


    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>

 <?php
 $message="";
 if(isset($_POST['submit'])){

     $user_name = $_POST['user_name'];
     $user_email = $_POST['user_email'];
     $user_password = $_POST['user_password'];
     if(!empty($user_name)&&!empty($user_email)&&!empty($user_password)){
         registerUserPdo($user_name,$user_password,$user_email,$pdo);
         $message = "Registration Completed";

     }
     else{
         /*echo "<script>alert('Fields can not be left empty!!')</script>";*/
         $message = "Fill out all the fields.";

     }

 }
 ?>
    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h4 class="text-center"><?php echo $message?></h4>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
