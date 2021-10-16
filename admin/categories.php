<?php include "includes/admin_header.php" ?>
<?php include_once "../includes/functions_mysqli.php" ?>
<?php include_once "../includes/functions_pdo.php" ?>
<?php include_once "../includes/db_pdo.php" ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            CATEGORY PAGE
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
                            <!--Add Category form-->
                            <?php
                            if (isset($_POST['addCategory'])) {
                                $cat_title = $_POST['cat_title'];
                                addCategoryPdo($cat_title,$pdo);
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" type="submit" name="addCategory"
                                           value="Add Category">
                                </div>
                            </form>
                            <!--Add Category form-->
                            <!--Update Category form-->
                            <?php
                            $hidden = "hidden";
                            $cat_title = "";
                            if (isset($_GET['updateid'])) {
                                $cat_id = $_GET['updateid'];
                                $cat_title = $_GET['updatetitle'];
                                $hidden = "";
                                //header("Location: categories.php");

                            }

                            ?>

                            <form action="" method="post" <?php echo $hidden; ?>>
                                <div class="form-group">
                                    <label for="">Update Category</label>
                                    <input class="form-control" type="text" name="cat_title"
                                           value="<?php echo $cat_title ?>">
                                    <input class="form-control" type="hidden" name="cat_id"
                                           value="<?php echo $cat_id ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" type="submit" name="updateCategory"
                                           value="Update Category">
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['updateCategory'])) {
                                $cat_id = $_POST['cat_id'];
                                $cat_title = $_POST['cat_title'];
                                updateCategoryPdo($cat_id, $cat_title,$pdo);
                                header("Location: categories.php");
                            }
                            ?>

                            <!--update Category form-->
                        </div>

                        <div class="col-xs-6">
                            <label>Categories</label>
                            <table class=" table table-bordered table-hover text-center">
                                <thead>
                                <th class="text-center">Id</th>
                                <th class="text-center">Category Title</th>
                                <th colspan="1" class="text-center">Action</th>
                                </thead>
                                <tbody>
                                <?php
                                //without prepared statement
                                /*$categoryList = getCategoryList();
                                while ($category = $categoryList->fetch_assoc()) {*/
                                //with prepared statement
                                $categoryList = getCategoryListPdo($pdo);
                                foreach ($categoryList as $category) {
                                    $cat_id = $category['cat_id'];
                                    $cat_title = $category['cat_title'];
                                    echo "<tr>
                                                <td>{$cat_id}</td>
                                                <td>{$cat_title}</td>
                                                <td><a class='btn btn-sm btn-danger' href='categories.php?delete={$cat_id}'>DELETE</a><span>&nbsp;&nbsp;</span>
                                                <a class='btn btn-sm btn-primary' href='categories.php?updateid={$cat_id}&amp;updatetitle={$cat_title}'>UPDATE</a></td>
                                          </tr>";
                                }
                                ?>
                                <?php
                                if (isset($_GET['delete'])) {
                                    $cat_id = $_GET['delete'];
                                    deleteCategoryPdo($cat_id,$pdo);
                                    header("Location: categories.php");
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<?php include "includes/admin_footer.php" ?>