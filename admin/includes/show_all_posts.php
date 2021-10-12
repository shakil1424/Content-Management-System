<?php include_once "../includes/functions.php" ?>
<?php
if (isset($_POST['post_id_list'])) {
    foreach ($_POST['post_id_list'] as $post_id) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'draft':
            case 'published':
                changePostStatus($post_id, $bulk_options);
                break;
            case 'delete':
                deletePost($post_id);
                break;
            case 'clone':
                clonePost($post_id);
                break;
        }

    }


} ?>


<form action="" method="post">


    <table class="table table-bordered text-center table-condensed table-responsive">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="clone">Clone</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th class="text-center">Id</th>
            <th class="text-center">Title</th>
            <th class="text-center">Author</th>
            <th class="text-center">Category</th>
            <th class="text-center">Status</th>
            <th class="text-center">Date</th>
            <th class="text-center">Image</th>
            <th class="text-center">Tags</th>
            <th class="text-center">Views</th>
            <th class="text-center">Comments</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $postList = getPostListForAdmin();
        $count = mysqli_num_rows($postList);
        if ($count == 0) {
            echo "NO POST AVAILABLE";

        } else {
            while ($post = $postList->fetch_assoc()) {
                $post_id = $post['post_id'];
                $post_title = $post['post_title'];
                $post_author = $post['post_author'];
                $post_category_id = $post['post_category_id'];
                $post_category_title = $post['cat_title'];
                $post_date = $post['post_date'];
                $post_content = $post['post_content'];
                $post_tags = $post['post_tags'];
                $post_status = $post['post_status'];
                $post_image = $post['post_image'];
                $post_comment_count = $post['post_comment_count'];
                $post_view_count = $post['post_view_count'];
                echo "<tr>";
                ?>
                <td><input class="checkBoxes" type="checkbox" name="post_id_list[]" value="<?php echo $post_id ?>">
                </td>
                <?php
                echo "<td>{$post_id}</td>
                      <td>{$post_title}</td>
                      <td>{$post_author}</td>
                      <td>{$post_category_title}</td>
                      <td>{$post_status}</td>
                      <td>{$post_date}</td>
                      <td><img width='50' src='images/{$post_image}'></td>
                      <td>{$post_tags}</td>
                      <td>{$post_view_count}&nbsp;&nbsp;
                      <a onClick=\"javascript: return confirm('Are you sure you want to reset views?');\" class='btn btn-xs btn-info' href='posts.php?reset_view={$post_id}'>RESET</a>
                      </td>
                      <td>{$post_comment_count}</td>
                      <td>
                      <div class='btn-group' role='action' aria-label='post_action'>
                      <a class='btn btn-xs btn-primary ' href='../post.php?post_id={$post_id}'>VIEW</a>
                      <a class='btn btn-xs btn-info ' href='posts.php?source=update_post&amp;post_id={$post_id}'>UPDATE</a>
                      <a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" class='btn btn-xs btn-danger' href='posts.php?delete={$post_id}'>DELETE</a>
                      </div>
                      </td>
                      
                  </tr>";
            }
        }
        ?>
        <?php
        if (isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            deletePost($post_id);
            header("Location: posts.php");
        }
        if (isset($_GET['reset_view'])) {
            $post_id = $_GET['reset_view'];
            resetPostViewCount($post_id);
            header("Location: posts.php");
        }
        ?>


        </tbody>

    </table>

</form>