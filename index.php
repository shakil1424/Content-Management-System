<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include_once "includes/functions.php" ?>


    <!-- Navigation -->
<?php

$search = "";
if (isset($_POST['submit'])) {
    $search = $_POST['search'];

}
if (isset($_GET['cat_id'])) {
    $post_category_id = $_GET['cat_id'];
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

            if (strlen($search) != 0) {
                $postList = getCustomPostList($search);
            } elseif (isset($_GET['cat_id'])) {
               $postList = getPostByCategory($post_category_id);

            } else {
                $postList = getPostList();
            }
            $count = mysqli_num_rows($postList);
            if ($count == 0) {
                echo "NO POST AVAILABLE";

            } else {
                while ($post = $postList->fetch_assoc()) {
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_content = substr($post['post_content'],0,100);
                    $post_tags = $post['post_tags'];
                    $post_status = $post['post_status'];
                    $post_image = $post['post_image'];


                    ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <a href="post.php?post_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="admin/images/<?php echo $post_image; ?>" alt="">
                    </a>
                    <hr>

                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                <?php }
            } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php" ?>