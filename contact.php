<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include_once "includes/functions_mysqli.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php


$message = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $subject = wordwrap($_POST['subject']);
    $body = $_POST['body'];

    if (!empty($email) && !empty($subject) && !empty($body)) {
        $header = "From: " . $email;
        $to = "shakil1424@gmail.com";
        mail($to, $subject, $body, $header);
        $message = "Email Sent";


    }
} else {
    $message = "Fill out all the fields.";


}
?>
<!-- Page Content -->
<div class="container">

    <section id="email">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <h4 class="text-center"><?php echo $message ?></h4>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email </label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="key" class="form-control"
                                       placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Send Mail">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "includes/footer.php"; ?>
