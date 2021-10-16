<?php
include_once "db_pdo.php" ?>

<?php
function getCategoryListPdo(PDO $pdo)
{
    $query = "SELECT * FROM categories";
    $statement = $pdo->query($query);
    $categoryList = $statement->fetchAll();
    return $categoryList;

}

function addCategoryPdo($cat_title, PDO $pdo)
{
    $query = "INSERT INTO categories (cat_title) ";
    $query .= "VALUE (:cat_title)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':cat_title', $cat_title);
    $statement->execute();

}

function deleteCategoryPdo($cat_id, PDO $pdo)
{

    $query = "DELETE FROM categories WHERE cat_id = :cat_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->execute();
}

function updateCategoryPdo($cat_id, $cat_title, PDO $pdo)
{
    $query = "UPDATE categories set cat_title = :cat_title ";
    $query .= "WHERE cat_id = :cat_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':cat_title', $cat_title);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->execute();

}

function getPostListForUserPdo($post_index, $post_per_page, PDO $pdo)
{
    $query = "SELECT * FROM posts JOIN categories ON ";
    $query .= "posts.post_category_id = categories.cat_id ";
    $query .= "WHERE post_status = 'published' ";
    $query .= "ORDER BY posts.post_id DESC ";
    $query .= "LIMIT :post_index, :post_per_page";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_index', $post_index, PDO::PARAM_INT);
    $statement->bindValue(':post_per_page', $post_per_page, PDO::PARAM_INT);
    $statement->execute();
    $postList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postList;

}

function getPostListForAdminPdo(PDO $pdo)
{
    $query = "SELECT * FROM posts JOIN categories ON ";
    $query .= "posts.post_category_id = categories.cat_id ";
    $query .= "ORDER BY posts.post_id DESC ";
    $statement = $pdo->query($query);
    $postList = $statement->fetchAll();
    return $postList;
}

function getCustomPostListPdo($search, $post_index, $post_per_page, PDO $pdo)
{
    $pattern = '%' . $search . '%';
    $query = "SELECT * FROM posts WHERE post_tags LIKE :search ";
    $query .= "AND post_status = 'published' ";
    $query .= "LIMIT :post_index, :post_per_page";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':search', $pattern);
    $statement->bindValue(':post_index', $post_index, PDO::PARAM_INT);
    $statement->bindValue(':post_per_page', $post_per_page, PDO::PARAM_INT);
    $statement->execute();
    $postList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postList;
}

function getCustomPostListCountPdo($search, PDO $pdo)
{
    $pattern = '%' . $search . '%';
    $query = "SELECT COUNT(*) FROM posts WHERE post_tags LIKE :search ";
    $query .= "AND post_status = 'published' ";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':search', $pattern);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count;
}

function getSinglePostPdo($post_id, PDO $pdo)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);
    return $post;

}

function getPostByCategoryPdo($cat_id, $post_index, $post_per_page, PDO $pdo)
{
    $query = "SELECT * FROM posts WHERE post_category_id = :cat_id ";
    $query .= "AND post_status = 'published' ";
    $query .= "LIMIT :post_index, :post_per_page";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->bindValue(':post_index', $post_index, PDO::PARAM_INT);
    $statement->bindValue(':post_per_page', $post_per_page, PDO::PARAM_INT);
    $statement->execute();
    $postList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postList;

}

function getPostByCategoryCountPdo($cat_id, PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM posts WHERE post_category_id = :cat_id ";
    $query .= "AND post_status = 'published' ";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count;

}

function getPostByAuthorPdo($post_author, $post_index, $post_per_page, PDO $pdo)
{
    $query = "SELECT * FROM posts WHERE post_author = :post_author ";
    $query .= "AND post_status = 'published' ";
    $query .= "LIMIT :post_index, :post_per_page";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_author', $post_author);
    $statement->bindValue(':post_index', $post_index, PDO::PARAM_INT);
    $statement->bindValue(':post_per_page', $post_per_page, PDO::PARAM_INT);
    $statement->execute();
    $postList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $postList;

}

function getPostByAuthorCountPdo($post_author, PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM posts WHERE post_author = :post_author ";
    $query .= "AND post_status = 'published' ";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_author', $post_author);
    $statement->execute();
    $count = $statement->fetchColumn();
    return $count;

}

function addPostPdo($post_category_id, $post_title, $post_author, $post_user,
                    $post_date, $post_status, $post_image, $post_tags,
                    $post_content, PDO $pdo)
{
    $query = "INSERT INTO posts (post_category_id,post_title,post_author,post_user,
            post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES (:post_category_id,:post_title,:post_author,:post_user,
           :post_date,:post_image,:post_content,:post_tags,:post_status)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_category_id', $post_category_id);
    $statement->bindValue(':post_title', $post_title);
    $statement->bindValue(':post_author', $post_author);
    $statement->bindValue(':post_user', $post_user);
    $statement->bindValue(':post_date', $post_date);
    $statement->bindValue(':post_image', $post_image);
    $statement->bindValue(':post_content', $post_content);
    $statement->bindValue(':post_tags', $post_tags);
    $statement->bindValue(':post_status', $post_status);
    $statement->execute();
    $last_id = $pdo->lastInsertId();
    return $last_id;
}

function updatePostPdo($post_id, $post_category_id, $post_title, $post_author,
                       $post_date, $post_status, $post_image, $post_tags,
                       $post_content, PDO $pdo)
{

    $query = "UPDATE posts SET  
            post_category_id = :post_category_id,
            post_title = :post_title,
            post_author = :post_author,
            post_date = :post_date,
            post_status = :post_status,
            post_image = :post_image,
            post_content = :post_content,
            post_tags = :post_tags
            WHERE post_id = :post_id";

    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_category_id', $post_category_id);
    $statement->bindValue(':post_title', $post_title);
    $statement->bindValue(':post_author', $post_author);
    $statement->bindValue(':post_date', $post_date);
    $statement->bindValue(':post_status', $post_status);
    $statement->bindValue(':post_image', $post_image);
    $statement->bindValue(':post_content', $post_content);
    $statement->bindValue(':post_tags', $post_tags);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
}

function changePostStatusPdo($post_id, $status, PDO $pdo)
{
    $query = "UPDATE posts SET post_status = :status ";
    $query .= "WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->bindValue(':status', $status);
    $statement->execute();

}

function deletePostPdo($post_id, PDO $pdo)
{
    $query = "DELETE FROM posts WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
}

function changePostCommentCountPdo($comment_post_id, $value, PDO $pdo)
{
    $query = "UPDATE posts SET post_comment_count = post_comment_count + :value ";
    $query .= "WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':value', $value, PDO::PARAM_INT);
    $statement->bindValue(':post_id', $comment_post_id);
    $statement->execute();
}

function increasePostViewCountPdo($post_id, PDO $pdo)
{
    $query = "UPDATE posts SET post_view_count = post_view_count + 1 ";
    $query .= "WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
}

function resetPostViewCountPdo($post_id, PDO $pdo)
{
    $query = "UPDATE posts SET post_view_count = 0 ";
    $query .= "WHERE post_id = :post_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
}

function clonePostPdo($post_id, PDO $pdo)
{
    $post = getSinglePostPdo($post_id, $pdo);
    $post_category_id = $post['post_category_id'];
    $post_title = $post['post_title'];
    $post_author = $post['post_author'];
    $post_user = $post['post_user'];
    $post_date = $post['post_date'];
    $post_tags = $post['post_tags'];
    $post_status = $post['post_status'];
    $post_image = $post['post_image'];
    $post_content = $post['post_content'];

    addPostPdo($post_category_id, $post_title, $post_author, $post_user,
        $post_date, $post_status, $post_image, $post_tags,
        $post_content, $pdo);

}

function getCommentListPdo(PDO $pdo)
{
    $query = "SELECT * FROM comments JOIN posts ON ";
    $query .= "comments.comment_post_id = posts.post_id";
    $statement = $pdo->query($query);
    $commentList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $commentList;

}

function deleteCommentPdo($comment_id, PDO $pdo)
{
    $query = "DELETE FROM comments WHERE comment_id = :comment_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->execute();

}

function addCommentPdo($comment_post_id, $comment_author, $comment_email,
                       $comment_content, $comment_date, PDO $pdo)
{

    $query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,
                    comment_content,comment_date) ";
    $query .= "VALUES (:comment_post_id,:comment_author,:comment_email,
                    :comment_content,:comment_date)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':comment_post_id', $comment_post_id);
    $statement->bindValue(':comment_author', $comment_author);
    $statement->bindValue(':comment_email', $comment_email);
    $statement->bindValue(':comment_content', $comment_content);
    $statement->bindValue(':comment_date', $comment_date);
    $statement->execute();

}

function updateCommentPdo($comment_id, $comment_status, PDO $pdo)
{
    $query = "UPDATE comments SET comment_status = :comment_status ";
    $query .= "WHERE comment_id  = :comment_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':comment_status', $comment_status);
    $statement->bindValue(':comment_id', $comment_id);
    $statement->execute();
}

function getCommentListByPostPdo($post_id, PDO $pdo)
{
    $query = "SELECT * FROM comments WHERE ";
    $query .= "comment_post_id = :post_id ";
    $query .= "AND comment_status = 1 ";
    $query .= "ORDER BY comment_id DESC ";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':post_id', $post_id);
    $statement->execute();
    $commentList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $commentList;
}

function getuserListPdo(PDO $pdo)
{
    $query = "SELECT * FROM users";
    $statement = $pdo->query($query);
    $userList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $userList;

}

function getSingleUserPdo($user_id, PDO $pdo)
{
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;

}

function addUserPdo($user_firstname, $user_lastname, $user_role, $user_name,
                    $user_password, $user_email, $user_image, PDO $pdo)
{

    $query = "INSERT INTO users (user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
    $query .= "VALUES (:user_name,:user_password,:user_firstname,:user_lastname,:user_email,:user_image,:user_role)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':user_password', $user_password);
    $statement->bindValue(':user_firstname', $user_firstname);
    $statement->bindValue(':user_lastname', $user_lastname);
    $statement->bindValue(':user_email', $user_email);
    $statement->bindValue(':user_image', $user_image);
    $statement->bindValue(':user_role', $user_role);
    $statement->execute();


}

function registerUserPdo($user_name, $user_password, $user_email, PDO $pdo)
{
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    $query = "INSERT INTO users (user_name,user_password,user_email,user_role) ";
    $query .= "VALUES (:user_name,:user_password,:user_email,'subscriber')";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':user_password', $user_password);
    $statement->bindValue(':user_email', $user_email);
    $statement->execute();

}


function updateUserPdo($user_id, $user_firstname, $user_lastname, $user_role,
                       $user_image, $user_name, $user_email, $user_password, PDO $pdo)
{
    $query = "UPDATE users SET  
            user_firstname = :user_firstname,
            user_lastname = :user_lastname,
            user_role = :user_role,
            user_name = :user_name,
            user_image = :user_image,
            user_email = :user_email,
            user_password = :user_password
            WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_firstname', $user_firstname);
    $statement->bindValue(':user_lastname', $user_lastname);
    $statement->bindValue(':user_role', $user_role);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':user_image', $user_image);
    $statement->bindValue(':user_email', $user_email);
    $statement->bindValue(':user_password', $user_password);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();

}
function deleteUserPdo($user_id, PDO $pdo)
{
    $query = "DELETE FROM users WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
}

function changeUserRolePdo($user_id, $changed_role, PDO $pdo)
{
    $query = "UPDATE users SET user_role = :changed_role ";
    $query .= "WHERE user_id  = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':changed_role', $changed_role);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
}
function getLoginUserPdo($user_name, PDO $pdo)
{
    $query = "SELECT * FROM users WHERE user_name = :user_name";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;

}
function getRowCountPdo($tableName, PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM " . $tableName;
    $statement = $pdo->query($query);
    $count = $statement->fetchColumn();
    return $count;
}

function getPublishedPostCountPdo(PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM posts WHERE post_status = 'published'";
    $statement = $pdo->query($query);
    $count = $statement->fetchColumn();
    return $count;
}

function getApprovedCommentCountPdo(PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM comments WHERE comment_status = '1'";
    $statement = $pdo->query($query);
    $count = $statement->fetchColumn();
    return $count;
}

function getAdminCountPdo(PDO $pdo)
{
    $query = "SELECT COUNT(*) FROM users WHERE user_role = 'admin'";
    $statement = $pdo->query($query);
    $count = $statement->fetchColumn();
    return $count;
}
?>

