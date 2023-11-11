<?php
session_start();

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Both username and password are required.";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT user_id, username, password, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password, $role);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                header("Location: booking.php");
            } else {
                $_SESSION['login_error'] = "Invalid password. Please try again.";
                header("Location: login.php");
            }
        } else {
            $_SESSION['login_error'] = "Login failed. Please try again.";
            header("Location: login.php");
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['login_error'] = "Login failed. Please try again.";
        header("Location: login.php");
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo.png" style="height: 71px; overflow: hidden;" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.html">Home</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="banner_main">
        <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="images/banner1.jpg" alt="First slide">
                    <div class="container">
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="booking_ocline">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="book_room ">
                            <h1>Login</h1> <br>
                            <div class="justify-content-center d-flex">
                                <div id="" class="d-flex justify-content-center">
                                    <div>
                                        <form class="form-control" action="login.php" method="post">
                                            <label for="username">Username:</label> <br>
                                            <input class="form-control" type="text" name="username" id="username"
                                                required><br>
                                            <br>
                                            <label for="password">Password:</label> <br>
                                            <input class="form-control" type="password" name="password" id="password"
                                                required><br>
                                            <div class="d-flex justify-content-center">
                                                <input class="btn btn-primary" type="submit" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div><br>
                                <div class="d-flex justify-content-center">
                                <span class="text-white">Don't have an account? <a href="register.php">Signup</a></span>
                            </div>
                            </div> 
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>