<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include_once "includes/functions.php" ?>


    <!-- Navigation -->
<?php

$search = "";
$post_per_page = 2;
$totalPostCount = getRowCount('posts');
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $totalPostCount = getCustomPostListCount($search);
    }
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (!empty($search)) {
        $totalPostCount = getCustomPostListCount($search);
    }
}

if (isset($_GET['cat_id'])) {
    $post_category_id = $_GET['cat_id'];
    $totalPostCount = getPostByCategoryCount($post_category_id);
}
if (isset($_GET['post_author'])) {
    $post_author = $_GET['post_author'];
    $totalPostCount = getPostByAuthorCount($post_author);
}
$totalPages = ceil($totalPostCount / $post_per_page);
if (isset($_GET['page_number'])) {
    $page_number = $_GET['page_number'];
} else {
    $page_number = 1;
}
$post_index = ($page_number - 1) * $post_per_page;
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
                $postList = getCustomPostList($search, $post_index, $post_per_page);
            } elseif (isset($_GET['cat_id'])) {
                $postList = getPostByCategory($post_category_id, $post_index, $post_per_page);
            } elseif (isset($_GET['post_author'])) {
                $postList = getPostByAuthor($post_author, $post_index, $post_per_page);
            } else {
                $postList = getPostListForUser($post_index, $post_per_page);
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
                    $post_content = substr($post['post_content'], 0, 100);
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
    <ul class="pager">
        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($page_number == $i) {
                $active = 'active_link';
            } else {
                $active = '';
            }
            if (isset($_GET['cat_id'])) {
                echo "<li class='{$active}'><a href='index.php?page_number={$i}&amp;cat_id={$post_category_id}'>$i</a></li>";
            } else if (isset($_GET['post_author'])) {
                echo "<li class='{$active}'><a href='index.php?page_number={$i}&amp;post_author={$post_author}'>$i</a></li>";
            } else if (!empty($search)) {
                echo "<li class='{$active}'><a href='index.php?page_number={$i}&amp;search={$search}'>$i</a></li>";
            } else {
                echo "<li class='{$active}'><a href='index.php?page_number={$i}'>$i</a></li>";
            }

        }
        ?>
    </ul>

<?php include "includes/footer.php" ?>