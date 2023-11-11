<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['registration_error'] = "All fields are required.";
        header("Location: register.php");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['registration_error'] = "Invalid email format.";
        header("Location: register.php");
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['registration_success'] = "Registration successful. You can now login.";
            header("Location: login.php");
        } else {
            $_SESSION['registration_error'] = "Registration failed. Please try again.";
            header("Location: register.php");
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['registration_error'] = "Registration failed. Please try again.";
        header("Location: register.php");
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
</head>

<body>
    <h2>User Registration</h2>
    <?php
    if (isset($_SESSION['registration_success'])) {
        echo "<div class='success-message'>" . $_SESSION['registration_success'] . "</div>";
        unset($_SESSION['registration_success']);
    }
    if (isset($_SESSION['registration_error'])) {
        echo "<div class='error-message'>" . $_SESSION['registration_error'] . "</div>";
        unset($_SESSION['registration_error']);
    }
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
            <!-- header inner -->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="index.html"><img src="images/logo.png" style="height: 71px;"
                                                alt="#" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarsExample04" aria-controls="navbarsExample04"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.html">Home</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="login.php">Sign In</a>
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
                                <h1>Signup</h1> <br>
                                <div class="justify-content-center d-flex">
                                    <div id="" class="d-flex justify-content-center">
                                        <div class="register">
                                            <form class="form-control border-2" action="register.php" method="post">
                                                <label for="username">Username:</label>
                                                <input class="form-control" type="text" placeholder="Username "
                                                    name="username" id="username" required><br>
                                                <label for="email">Email:</label>
                                                <input class="form-control" placeholder="user@gmail.com" type="email"
                                                    name="email" id="email" required><br>
                                                <label for="password">Password:</label>
                                                <input class="form-control " type="password" name="password"
                                                    id="password" required><br>
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-primary" type="submit" value="Register">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <span class="text-light text-center">Already Have an account? <a
                                            href="login.php">Login</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>

    </html>