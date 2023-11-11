<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php"); // Redirect logged-in admins to the admin dashboard
    exit();
}
// Check for admin username and password
$admin_username = "admin";
$admin_password = "admin";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $admin_username && $input_password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "<span>Invalid admin username or password.</span>";
    }
}
?>

<!DOCTYPE html>

<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    span{
        font-size: 30px;
        text-align: center;
        margin-left: 35%;
        color: red;
    }
</style>

<body style="background-image:url('./images/banner3.jpg');color: azure;">
    <h2 class="text-center mt-5">Admin Login</h2>
    <div class="main">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4  border border-2 p-2 rounded-2">
                <form class="form-control bg-light" method="post" action="admin_login.php">
                    <label for="username">Admin Username:</label>
                    <input class="form-control" type="text" name="username" id="username" required><br>
                    <label class="form-text" for="password">Admin Password:</label>
                    <input class="form-control" type="password" name="password" id="password" required><br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-warning" type="submit" value="Login as Admin">
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>