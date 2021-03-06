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
                            USERS PAGE
                        </h1>

                        <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }
                        switch ($source) {
                            case 'add_user':
                                include "includes/add_user.php";
                                break;

                            case 'update_user':
                                include "includes/add_user.php";;
                                break;
                            default:
                                include "includes/show_all_users.php";
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