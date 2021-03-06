<?php include_once "includes/db_pdo.php" ?>
<?php include_once "includes/functions_mysqli.php" ?>
<?php include_once "includes/functions_pdo.php" ?>

<div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">
        <h4>Blog Search</h4>
        <form action="index.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <!-- login form -->

    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="user_name" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input name="user_password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="login">
                                SUBMIT
                            </button>
                </span>
            </div>
        </form>
        <!-- /.login form -->
    </div>

    <!-- Blog Categories Well -->

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $categoryList = getCategoryListPdo($pdo);
                    foreach ($categoryList as $category) {
                        $cat_id = $category['cat_id'];
                        $cat_title = $category['cat_title'];
                        echo "
                    <li>
                    <a href=\"index.php?cat_id={$cat_id}\">{$cat_title}</a>
                    </li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
            accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>