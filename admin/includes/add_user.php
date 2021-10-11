<?php include_once "../includes/functions.php" ?>
<?php
$buttonName = "Create user";
$value = '';
$user_id = '';
$actionName = "create_user";
$user_firstname = '';
$user_name = '';
$user_lastname = '';
$user_password = '';
$user_email = '';
$user_role = '';
$user_image = '';

if (isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];
    $buttonName = "Update User";
    $actionName = "update_user";
    $value = "checking update";
    $userList = getSingleUser($user_id);
    while ($user = $userList->fetch_assoc()) {
        $user_firstname = $user['user_firstname'];
        $user_name = $user['user_name'];
        $user_lastname = $user['user_lastname'];
        $user_password = $user['user_password'];
        $user_email = $user['user_email'];
        $user_role = $user['user_role'];
        $user_image = $user['user_image'];
    }

}
if (isset($_POST['create_user'])) {
    //echo "got the user request";
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($user_image_temp, "images/$user_image");
    addUser($user_firstname, $user_lastname, $user_role, $user_name,
        $user_password, $user_email, $user_image);
    header("Location: users.php");
}
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

    $user_name = $_POST['user_name'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($user_image_temp, "images/$user_image");
    if (empty($user_image)) {
        $user_image = $_POST['old_user_image'];
    }
    updateUser($user_id, $user_firstname, $user_lastname, $user_role,
        $user_image, $user_name, $user_email, $user_password);
    header("Location: users.php");
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Enter first name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Enter last name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    <div class="form-group">
        <!--<label for="user_roles">Select Category</label>-->
        <label>Roles:</label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin" <?php if ($user_role == "admin") echo "selected" ?>>Admin</option>
            <option value="subscriber" <?php if ($user_role == "subscriber") echo "selected" ?>>Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_name">Enter your username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Enter email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Enter password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <label for="user_image">User image</label>
        <?php
        if (isset($_GET['user_id'])) {
            echo "<img width='100' src='images/{$user_image}'>";
            echo "<input type=\"hidden\" class=\"form-control\" name=\"old_user_image\" value=\"{$user_image}\">";
            echo "<input type=\"hidden\" class=\"form-control\" name=\"user_id\" value=\"{$user_id}\">";

        } ?>
        <input type="file" class="form-control" name="image">
    </div>
    <!--<div class="form-group">
            <label for="user_roles">Enter your role</label>
            <input type="text" class="form-control" name="user_role" value="<?php /*echo $user_role; */ ?>">
        </div>-->

    <div class="form-group">

        <input type="submit" class="form-control btn btn-primary" name="<?php echo $actionName; ?>"
               value="<?php echo $buttonName; ?>">
    </div>
</form>