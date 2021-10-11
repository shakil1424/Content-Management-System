<?php include_once "db.php" ?>

<?php
function getCategoryList()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $categoryList = mysqli_query($connection, $query);
    return $categoryList;

}

function addCategory($cat_title)
{
    global $connection;
    $query = "INSERT INTO categories (cat_title)";
    $query .= "VALUE ('$cat_title')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Insert category is failed " . mysqli_error($connection));
    }
}

function deleteCategory($cat_id)
{
    global $connection;
    $query = "DELETE FROM categories WHERE cat_id = '$cat_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Delete Category is failed " . mysqli_error($connection));
    }
}

function updateCategory($cat_id, $cat_title)
{
    global $connection;
    $query = "UPDATE categories SET cat_title = '$cat_title' ";
    $query .= "WHERE cat_id = '$cat_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Update category is failed " . mysqli_error($connection));
    }
}

function getPostList()
{
    global $connection;
    $query = "SELECT * FROM posts JOIN categories ON ";
    $query .= "posts.post_category_id = categories.cat_id";
    $postList = mysqli_query($connection, $query);
    return $postList;

}

function getCustomPostList($search)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    $postList = mysqli_query($connection, $query);
    return $postList;

}

function getSinglePost($post_id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
    $postList = mysqli_query($connection, $query);
    return $postList;

}

function getPostByCategory($cat_id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_category_id = '$cat_id'";
    $postList = mysqli_query($connection, $query);
    return $postList;

}

function addPost($post_category_id, $post_title, $post_author, $post_user,
                 $post_date, $post_status, $post_image, $post_tags,
                 $post_content)
{

    global $connection;
    $query = "INSERT INTO posts (post_category_id,post_title,post_author,post_user,
            post_date,post_image,post_content,post_tags,
            post_status) VALUES ('$post_category_id','$post_title','$post_author','$post_user',
           now(),'$post_image','$post_content','$post_tags',
            '$post_status')";


    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Insert comment is failed " . mysqli_error($connection));
    }
    else{
        return mysqli_insert_id($connection);
    }

}

function updatePost($post_id, $post_category_id, $post_title, $post_author,
                    $post_date, $post_status, $post_image, $post_tags,
                    $post_content)
{

    global $connection;
    $query = "UPDATE posts SET  
            post_category_id = '$post_category_id',
            post_title = '$post_title',
            post_author = '$post_author',
            post_date = now(),
            post_status = '$post_status',
            post_image = '$post_image',
            post_content = '$post_content',
            post_tags = '$post_tags'
            WHERE post_id = '$post_id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("update comment is failed " . mysqli_error($connection));
    }

}
function changePostStatus($post_id,$status){
    global $connection;
    $query = "UPDATE posts SET post_status = '$status' ";
    $query .= "WHERE post_id = '$post_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("update post_status is failed " . mysqli_error($connection));
    }

}

function deletePost($post_id)
{
    global $connection;
    $query = "DELETE FROM posts WHERE post_id = '$post_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Delete post is failed " . mysqli_error($connection));
    }
}

function changePostCommentCount($comment_post_id, $value)
{
    global $connection;
    $query = "UPDATE posts SET post_comment_count = post_comment_count + '$value' ";
    $query .= "WHERE post_id = '$comment_post_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("update comment_count is failed " . mysqli_error($connection));
    }
}

function getCommentList()
{
    global $connection;
    $query = "SELECT * FROM comments JOIN posts ON ";
    $query .= "comments.comment_post_id = posts.post_id";
    $commentList = mysqli_query($connection, $query);
    return $commentList;

}

function deleteComment($comment_id)
{
    global $connection;
    $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Delete comment is failed " . mysqli_error($connection));
    }
}

function addComment($comment_post_id, $comment_author, $comment_email,
                    $comment_content, $comment_date)
{
    global $connection;
    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,
                    comment_content,comment_date) ";
    $query .= "VALUES ('$comment_post_id','$comment_author','$comment_email',
                    '$comment_content',now() )";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Insert comment is failed " . mysqli_error($connection));
    }
}

function updateComment($comment_id, $comment_status)
{
    global $connection;
    $query = "UPDATE comments SET comment_status = '$comment_status' ";
    $query .= "WHERE comment_id  = '$comment_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Comment Update is failed " . mysqli_error($connection));
    }
}

function getCommentListByPost($post_id)
{
    global $connection;
    $query = "SELECT * FROM comments WHERE ";
    $query .= "comment_post_id = '$post_id' ";
    $query .= "AND comment_status = 1 ";
    $query .= "ORDER BY comment_id DESC ";
    $commentList = mysqli_query($connection, $query);
    return $commentList;

}

function getuserList()
{
    global $connection;
    $query = "SELECT * FROM users";

    $userList = mysqli_query($connection, $query);
    return $userList;
}

function addUser($user_firstname, $user_lastname, $user_role, $user_name,
                 $user_password, $user_email, $user_image)
{
    global $connection;
    $query = "SELECT randSalt FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Salting is failed " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($result);
    $salt = $row['randSalt'];
    $user_password = crypt($user_password,$salt);
    $query = "INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
    $query .= "VALUES ('$user_name','$user_password','$user_firstname','$user_lastname','$user_email','$user_image','$user_role')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Insert category is failed " . mysqli_error($connection));
    }

}
function registerUser($user_name,$user_password,$user_email){
    global $connection;
    $user_name = mysqli_real_escape_string($connection,$user_name);
    $user_password = mysqli_real_escape_string($connection,$user_password);
    $user_email = mysqli_real_escape_string($connection,$user_email);

    $query = "SELECT randSalt FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Salting is failed " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($result);
    $salt = $row['randSalt'];
    $user_password = crypt($user_password,$salt);

    $query = "INSERT INTO users (user_name,user_password,user_email,user_role) ";
    $query .= "VALUES ('$user_name','$user_password','$user_email','subscriber')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Registration is failed " . mysqli_error($connection));
    }



}

function getSingleUser($user_id)
{
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $userList = mysqli_query($connection, $query);
    return $userList;
}

function updateUser($user_id, $user_firstname, $user_lastname, $user_role,
                    $user_image, $user_name, $user_email, $user_password)
{
    global $connection;
    $query = "SELECT randSalt FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Salting is failed " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($result);
    $salt = $row['randSalt'];
    $user_password = crypt($user_password,$salt);
    $query = "UPDATE users SET  
            user_firstname = '$user_firstname',
            user_lastname = '$user_lastname',
            user_role = '$user_role',
            user_name = '$user_name',
            user_image = '$user_image',
            user_email = '$user_email',
            user_password = '$user_password'
            WHERE user_id = '$user_id'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("update comment is failed " . mysqli_error($connection));
    }
}
function deleteUser($user_id){
    global $connection;
    $query = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Delete user is failed " . mysqli_error($connection));
    }
}

function changeUserRole($user_id,$changed_role){
    global $connection;
    $query = "UPDATE users SET user_role = '$changed_role' ";
    $query .= "WHERE user_id  = '$user_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("User Update is failed " . mysqli_error($connection));
    }
}
function getLoginUser($user_name,$user_password){
    global $connection;
    $user_name = mysqli_real_escape_string($connection,$user_name);
    $user_password = mysqli_real_escape_string($connection,$user_password);
    $query = "SELECT randSalt FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die ("Salting is failed " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($result);
    $salt = $row['randSalt'];
    $user_password = crypt($user_password,$salt);
    $query = "SELECT * FROM users WHERE user_name = '$user_name' AND user_password = '$user_password'";
    $userList = mysqli_query($connection, $query);
    if (!$userList) {
        die ("User Update is failed " . mysqli_error($connection));
    }else{
        return $userList;
    }

}
function getRowCount($tableName){
    global $connection;
    $query = "SELECT * FROM ".$tableName;
    $result = mysqli_query($connection, $query);
    if(!$result){
        die ("Table row count is failed " . mysqli_error($connection));
    }
    return mysqli_num_rows($result);
}
function getPublishedPostCount()
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'published'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die ("User Update is failed " . mysqli_error($connection));
    }
    return mysqli_num_rows($result);
}
function getApprovedCommentCount()
{
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_status = '1'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die ("User Update is failed " . mysqli_error($connection));
    }
    return mysqli_num_rows($result);
}
function getAdminCount()
{
    global $connection;
    $query = "SELECT * FROM users WHERE user_role = 'admin'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die ("User Update is failed " . mysqli_error($connection));
    }
    return mysqli_num_rows($result);
}

?>
