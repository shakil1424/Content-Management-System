<?php include_once "../includes/functions.php" ?>
<table class="table table-bordered text-center">
    <thead>
    <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Comment</th>
        <th class="text-center">Author</th>
        <th class="text-center">Email</th>

        <th class="text-center">Date</th>
        <th class="text-center">In Response to</th>
        <th class="text-center">Status</th>
        <th class="text-center">Change Status</th>

        <th class="text-center">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $status = "Disapproved";
    $commentList = getCommentList();
    $count = mysqli_num_rows($commentList);
    if ($count == 0) {
        echo "NO Comment AVAILABLE";

    } else {
        while ($comment = $commentList->fetch_assoc()) {
            $comment_id = $comment['comment_id'];
            $comment_content = $comment['comment_content'];
            $comment_author = $comment['comment_author'];
            $comment_email = $comment['comment_email'];
            $comment_status = $comment['comment_status'];
            if ($comment_status == 1) {
                $status = "Approved";
            }else{
                $status = "Disapproved";
            }
            $comment_date = $comment['comment_date'];
            $comment_post_id = $comment['comment_post_id'];
            $comment_post_title = $comment['post_title'];
            echo "
                  <tr>
                      <td>{$comment_id}</td>
                      <td>{$comment_content}</td>
                      <td>{$comment_author}</td>
                      <td>{$comment_email}</td>
                     
                      <td>{$comment_date}</td>
                       
                      <td><a href=\"../post.php?post_id={$comment_post_id}\">{$comment_post_title}</a></td>
                      <td>{$status}</td>";
            if ($comment_status == 1) {
                echo "<td><a class='btn btn-sm btn-danger' href='comments.php?comment_status={$comment_status}&amp;comment_id={$comment_id}'>DISAPPROVE</a></td>";
            } else {
                echo "<td><a class='btn btn-sm btn-success' href='comments.php?comment_status={$comment_status}&amp;comment_id={$comment_id}'>APPROVE</a></td>";
            }
                echo "<td><a class='btn btn-sm btn-danger' href='comments.php?delete={$comment_id}&amp;comment_post_id={$comment_post_id}'>DELETE</a></td>
                   </tr>";
        }
    }
    ?>
    <?php
    if (isset($_GET['delete'])) {
        $comment_post_id = $_GET['comment_post_id'];
        $comment_id = $_GET['delete'];
        deleteComment($comment_id);
        changePostCommentCount($comment_post_id,-1);
        header("Location: comments.php");
    }
    if (isset($_GET['comment_status'])) {
        $comment_id = $_GET['comment_id'];
        $comment_status = $_GET['comment_status'];
        if($comment_status ==1){
            UpdateComment($comment_id,0);
        }else{
            UpdateComment($comment_id,1);
        }

        header("Location: comments.php");
    }
    ?>


    </tbody>

</table>