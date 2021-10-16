<?php include_once "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include_once "includes/functions_mysqli.php" ?>
<?php include_once "includes/functions_pdo.php" ?>


    <!-- Navigation -->
<?php
$user_role = "";
$visibility = "true";
if (isset($_SESSION['user_role'])) {
    $user_role = $_SESSION['user_role'];
}
$search = "";
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

}
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

} else {
    header("Location: index.php");
}

?>
<?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>


            <?php
            $post = getSinglePostPdo($post_id, $pdo);
            $post_id = $post['post_id'];
            $post_title = $post['post_title'];
            $post_author = $post['post_author'];
            $post_date = $post['post_date'];
            $post_content = $post['post_content'];
            $post_tags = $post['post_tags'];
            $post_status = $post['post_status'];
            $post_image = $post['post_image'];

            if ($post_status == "draft" && $user_role != "admin") {
                $visibility = false;
            }


            if ($visibility == "true") {
                increasePostViewCountPdo($post_id,$pdo); ?>


                <h2>
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php?post_author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>

                <!-- Blog Comments -->
                <!-- Comments Form -->
                <?php
                if (isset($_POST['create_comment'])) {
                    $comment_post_id = $_POST['comment_post_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $comment_date = date('Y-m-d');
                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        addCommentPdo($comment_post_id, $comment_author, $comment_email,
                            $comment_content, $comment_date,$pdo);
                        changePostCommentCountPdo($comment_post_id, 1, $pdo);
                        header("Location: post.php?post_id={$comment_post_id}");
                    } else {
                        echo "<script>alert('Fields can not be left empty!!')</script>";

                    }

                }

                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author" value="">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email" value="">
                        </div>
                        <input type="hidden" name="comment_post_id" value="<?php echo $post_id; ?>">
                        <div class="form-group">
                            <label for="comment_content">Enter your comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" id="commentBody" cols="30"
                                      rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php
                $commentList = getCommentListByPostPdo($post_id, $pdo);
                foreach ($commentList as $comment) {
                    $post_author = $comment['comment_author'];
                    $post_date = $comment['comment_date'];
                    $post_content = $comment['comment_content'];
                    ?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $post_author; ?>
                                <small><?php echo $post_date; ?></small>
                            </h4>
                            <?php echo $post_content; ?>
                        </div>
                    </div>

                <?php }
            } else {
                echo "No post is available";
            }
            ?>


            <!-- First Blog Post -->


            <!-- End Nested Comment -->
        </div>


        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php" ?>