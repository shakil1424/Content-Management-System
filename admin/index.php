<?php include "includes/admin_header.php" ?>
<?php include_once "../includes/db_pdo.php" ?>
<?php include "../includes/functions_mysqli.php" ?>
<?php include "../includes/functions_pdo.php" ?>


    <div id="wrapper">

        <?php
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'subscriber') {
                header("Location: ../index.php");
            }
        }
        ?>
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['user_name'] ?></small>
                        </h1>
                        <!-- <ol class="breadcrumb">
                             <li>
                                 <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                             </li>
                             <li class="active">
                                 <i class="fa fa-file"></i> Blank Page
                             </li>
                         </ol>-->
                    </div>
                </div>


                <!-- /.row -->
                <?php
                $postCount = getRowCountPdo("posts",$pdo);
                $publishedPostCount = getPublishedPostCountPdo($pdo);
                $draftPostCount = $postCount - $publishedPostCount;
                $commentCount = getRowCountPdo("comments",$pdo);
                $approvedCommentCount = getApprovedCommentCountPdo($pdo);
                $newCommentCount = $commentCount - $approvedCommentCount;
                $userCount = getRowCountPdo("users",$pdo);
                $adminCount = getAdminCountPdo($pdo);
                $subscriberCount = $userCount - $adminCount;
                $categoryCount = getRowCountPdo("categories",$pdo);

                ?>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class='huge'><?php echo $postCount ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $commentCount; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $userCount; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $categoryCount; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load("current", {packages: ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ["Data", "Count", {role: "style"}],
                                <?php

                                $elementText = ["Total Post", "Published Post", "Draft Post",
                                    "Total Comment", "Approved Comment", "new Comment",
                                    "Total User", "Admin", "Subscriber",
                                    "Category"];
                                $elementCount = [$postCount, $publishedPostCount, $draftPostCount,
                                    $commentCount, $approvedCommentCount, $newCommentCount,
                                    $userCount, $adminCount, $subscriberCount,
                                    $categoryCount];

                                $elementColor = ["#6621e5", "#3d578b", "#6495ED",
                                    "#d5671f", "#CD5C5C", "#DC143C",
                                    "#0a8d3d", "#008B8B", "#7FFFD4",
                                    "#ad32db"];
                                for ($i = 0; $i < 10; $i++) {
                                    echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}" . "," . "'{$elementColor[$i]}'],";

                                }

                                ?>
                                 //colorCheck = "#ad32db";

                            ]);

                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                {
                                    calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation"
                                },
                                2]);

                            var options = {
                                title: "DATABASE",
                                width: "100%",
                                height: 400,
                                bar: {groupWidth: "50%"},
                                legend: {position: "none"},
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                            chart.draw(view, options);
                        }
                    </script>
                    <div id="columnchart_values" style="width: auto; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<?php include "includes/admin_footer.php" ?>