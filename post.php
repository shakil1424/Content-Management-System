<?php include_once "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include_once "includes/functions.php" ?>


    <!-- Navigation -->
<?php

$search = "";
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

}
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
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


            $postList = getSinglePost($post_id);

            while ($post = $postList->fetch_assoc()) {
                $post_id = $post['post_id'];
                $post_title = $post['post_title'];
                $post_author = $post['post_author'];
                $post_date = $post['post_date'];
                $post_content = $post['post_content'];
                $post_tags = $post['post_tags'];
                $post_status = $post['post_status'];
                $post_image = $post['post_image'];


                ?>
                <!-- First Blog Post -->
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
            <?php }
            ?>

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
                    addComment($comment_post_id, $comment_author, $comment_email,
                        $comment_content, $comment_date);
                    changePostCommentCount($comment_post_id, 1);
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
            $commentList = getCommentListByPost($post_id);
            while ($comment = $commentList->fetch_assoc()) {
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
            <?php } ?>
            <!-- End Nested Comment -->
        </div>


        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php" ?>