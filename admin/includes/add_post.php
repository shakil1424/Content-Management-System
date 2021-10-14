<?php include_once "../includes/functions.php" ?>
<?php
$buttonName = "Publish post";
$value = '';
$post_id = '';
$actionName = "create_post";
$post_title = '';
$post_author = '';
$post_category_id = '';
$post_content = '';
$post_tags = '';
$post_status = '';
if (isset($_GET['post_id'])) {

    //echo "UPDATE CALLED";
    $post_id = $_GET['post_id'];
    $buttonName = "Update Post";
    $actionName = "update_post";
    $value = "checking update";
    $postList = getSinglePost($post_id);
    while ($post = $postList->fetch_assoc()) {
        $post_title = $post['post_title'];
        $post_author = $post['post_author'];
        $post_category_id = $post['post_category_id'];
        $post_content = $post['post_content'];
        $post_tags = $post['post_tags'];
        $post_status = $post['post_status'];
        $post_image = $post['post_image'];
        $post_comment_count = $post['post_comment_count'];
    }

}
if (isset($_POST['create_post'])) {
    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_user = "user";
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('Y-m-d');

    move_uploaded_file($post_image_temp, "images/$post_image");
    $latest_post_id = addPost($post_category_id, $post_title, $post_author, $post_user,
        $post_date, $post_status, $post_image, $post_tags,
        $post_content);
    echo "<p class='bg-success'>Post Added.&nbsp;<a href='../post.php?post_id={$latest_post_id}'>View Post</a>&nbsp;or&nbsp;
        <a href='posts.php'>See All Post</a></p>";
    /*header("Location: posts.php");*/

}
if (isset($_POST['update_post'])) {
    $post_id = $_POST['post_id'];
    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    //$post_user = "user";
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('Y-m-d');
    //$post_comment_count = 4;
    //$post_view_count = 4;
    move_uploaded_file($post_image_temp, "images/$post_image");
    if (empty($post_image)) {
        $post_image = $_POST['old_post_image'];
    }
    updatePost($post_id, $post_category_id, $post_title, $post_author,
        $post_date, $post_status, $post_image, $post_tags,
        $post_content);
    echo "<p class='bg-success'>Post Updated.&nbsp;<a href='../post.php?post_id={$post_id}'>View Post</a>&nbsp;or&nbsp;
        <a href='posts.php'>Edit More Post</a></p>";
    //header("Location: posts.php");
    //echo $post_image . "received";

}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="category_id">Select Category</label>
        <select class="form-control" name="post_category_id" id="">
            <?php
            $categoryList = getCategoryList();
            while ($category = $categoryList->fetch_assoc()) {
                $cat_id = $category['cat_id'];
                $cat_title = $category['cat_title'];
                if (isset($_GET['post_id']) && $cat_id == $post_category_id) {
                    echo "<option value='$cat_id' selected>$cat_title</option>";
                } else {
                    echo "<option value='$cat_id'>$cat_title</option>";
                }

            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <!--<label for="user_roles">Select Category</label>-->
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="">
            <option value="draft" <?php if ($post_status == "draft") echo "selected" ?>>Draft</option>
            <option value="published" <?php if ($post_status == "published") echo "selected" ?>>Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post image</label>
        <?php
        if (isset($_GET['post_id'])) {
            echo "<img width='100' src='images/{$post_image}'>";
            echo "<input type=\"hidden\" class=\"form-control\" name=\"old_post_image\" value=\"{$post_image}\">";
            echo "<input type=\"hidden\" class=\"form-control\" name=\"post_id\" value=\"{$post_id}\">";

        } ?>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
            <?php echo $post_content; ?>
        </textarea>
    </div>
    <div class="form-group">

        <input type="submit" class="form-control btn btn-primary" name="<?php echo $actionName; ?>"
               value="<?php echo $buttonName; ?>">
    </div>
</form>