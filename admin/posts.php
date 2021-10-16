<?php include "includes/admin_header.php" ?>
<?php include_once "../includes/functions_mysqli.php" ?>

    <div id="wrapper">


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            POSTS PAGE
                            <small>Author</small>
                        </h1>
                        <!-- <ol class="breadcrumb">
                             <li>
                                 <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                             </li>
                             <li class="active">
                                 <i class="fa fa-file"></i> Blank Page
                             </li>
                         </ol>-->
                        <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        }else{
                            $source='';
                        }
                        switch ($source) {
                            case 'add_post':
                                include "includes/add_post.php";
                                break;

                            case 'update_post':
                                include "includes/add_post.php";;
                                break;
                            default:
                                include "includes/show_all_posts.php";
                                break;

                        }
                        ?>

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