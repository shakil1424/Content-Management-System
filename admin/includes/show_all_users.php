<?php include_once "../includes/functions.php" ?>
<table class="table table-bordered text-center">
    <thead>
    <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Name</th>
        <th class="text-center">Password</th>
        <th class="text-center">First Name</th>
        <th class="text-center">Last Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Image</th>
        <th class="text-center">Roles</th>
        <th class="text-center">Change Role</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $userList = getuserList();
    $count = mysqli_num_rows($userList);
    if ($count == 0) {
        echo "NO user AVAILABLE";

    } else {
        while ($user = $userList->fetch_assoc()) {
            $user_id = $user['user_id'];
            $user_name = $user['user_name'];
            $user_password = $user['user_password'];
            $user_firstname = $user['user_firstname'];
            $user_lastname = $user['user_lastname'];
            $user_email = $user['user_email'];
            $user_role = $user['user_role'];

            $user_image = $user['user_image'];

            echo "
                  <tr>
                      <td>{$user_id}</td>
                      <td>{$user_name}</td>
                      <td>{$user_password}</td>
                      <td>{$user_firstname}</td>
                      <td>{$user_lastname}</td>
                      <td>{$user_email}</td>
                      <td><img width='50' src='images/{$user_image}'></td>
                      <td>{$user_role}</td>
                      <td><a class='btn btn-sm btn-info' href='users.php?user_role={$user_role}&amp;user_id={$user_id}'>CHANGE ROLE</a></td>
                      <td><a class='btn btn-sm btn-danger' href='users.php?delete={$user_id}'>DELETE</a><span>&nbsp;&nbsp;</span>
                      <a class='btn btn-sm btn-info' href='users.php?source=update_user&amp;user_id={$user_id}'>UPDATE</a></td>
                      
                  </tr>";
        }
    }
    ?>
    <?php
    if (isset($_GET['delete'])) {
        if (isset($_GET['delete'])) {
            if(isset($_SESSION['user_role'])){
                if(isset($_SESSION['user_role'])=="admin"){
                    $user_id = $_GET['delete'];
                    deleteUser($user_id);
                    header("Location: users.php");
                }
            }

        }

    }
    if (isset($_GET['user_role'])) {
        $user_id = $_GET['user_id'];
        $user_role = $_GET['user_role'];
        $changed_role = "admin";
        if($user_role == "admin"){
            $changed_role = "subscriber";
        }
        changeUserRole($user_id,$changed_role);
        header("Location: users.php");
    }
    ?>


    </tbody>

</table>