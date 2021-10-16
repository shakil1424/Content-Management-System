<?php include_once "includes/db_pdo.php" ?>
<?php include_once "includes/functions_mysqli.php" ?>
<?php include_once "includes/functions_pdo.php" ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">PAPERBOY</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $categoryList = getCategoryListPdo($pdo);
                foreach($categoryList as $category){
                    $cat_id = $category['cat_id'];
                    $cat_title = $category['cat_title'];
                    echo "
                    <li>
                    <a href=\"index.php?cat_id={$cat_id}\">{$cat_title}</a>
                    </li>";
                }
                ?>
                <li>
                    <a href="admin">Admin</a>

                </li>
                <li>
                    <a href="registration.php">Registration</a>

                </li>
                <li>
                    <a href="contact.php">Contact Us</a>

                </li>
                <?php
                if(isset($_SESSION['user_role'])){
                    if(isset($_GET['post_id'])){
                        $post_id = $_GET['post_id'];
                        echo "
                    <li>
                    <a href='admin/posts.php?source=update_post&amp;post_id={$post_id}'>EDIT POST</a>
                    </li>";
                    }
                }
                    ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>