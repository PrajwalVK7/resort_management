<!DOCTYPE html>
<html>

<head>
    <title>Resort Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $room_type = $_POST['room_type'];
        $mob = $_POST['mob'];
        $guest = $_POST['guest'];

        if (empty($check_in) || empty($check_out) || empty($room_type) || empty($mob) || empty($guest)) {
            echo "<div class='error-message'>All fields are required.</div>";
        } else {

            $query = "INSERT INTO bookings (user_id, check_in, check_out, room_type, mob, guest, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $user_id, $check_in, $check_out, $room_type, $mob, $guest);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<div class='success-message'>Booking successful.</div>";
                } else {
                    echo "<div class='error-message'>Booking failed. Please try again.</div>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<div class='error-message'>Booking failed. Please try again.</div>";
            }
        }
    }

    mysqli_close($conn);
    ?>
    <div>
        <header>
            <!-- header inner -->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="index.html"><img src="images/logo.png" alt="#"
                                                style="height: 71px;" /></a>
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
                                        <li class="nav-item me-5" style="color:black; font-size:30px;">
                                            <?php if (isset($_SESSION['user_id'])) {
                                                echo "<span class='navbar-text text-black'>Hello, " . $_SESSION['username'] . "!</span>";
                                            }
                                            ?>

                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href="login.php">Home</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="#history">History</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="logout.php">Logout</a>
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
                        <div class="col-6">
                            <div class="book_room ">
                                <h1>Book Now</h1> <br>
                                <div class="justify-content-center d-flex">
                                    <div id="" class="d-flex justify-content-center">
                                        <div>
                                            <form class="form-control" action="booking.php" method="post">
                                                <label for="check_in">Check-In Date : </label>
                                                <input class="form-control" type="date" name="check_in" id="check_in"
                                                    required><br>
                                                <label for="check_out">Check-Out Date:</label>
                                                <input class="form-control" type="date" name="check_out" id="check_out"
                                                    required><br>
                                                <label for="mob">Mobile number</label> <br>
                                                <input type="tel" class="form-control" name="mob" id="mob" required><br>
                                                <label for="guest">No of Guest</label>
                                                <select name="guest" id="guest" class="form-control" required>
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                </select>
                                                <label for="room_type">Room Type:</label>
                                                <select name="room_type" id="room_type" required>
                                                    <option class="form-control" value="Single">Single</option>
                                                    <option class="form-control" value="Double">Double</option>
                                                    <option class="form-control" value="Suite">Suite</option>
                                                </select><br>
                                                <input class="btn btn-primary" type="submit" value="Book Now">
                                            </form>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section> <br>
        <section id="history">
            <div class="booking-hist d-flex justify-content-center align-items-center">
                <div>
                    <section id="history">
                        <div class="booking-hist d-flex justify-content-center align-items-center">
                            <div>
                                <h2>Booking History</h2>
                                <?php
                                include("config.php");
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT * FROM bookings WHERE user_id = ?";
                                $stmt = mysqli_prepare($conn, $query);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "s", $user_id);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    // Display booking history in a table
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<table class='table'>";
                                        echo "<thead><tr><th>Check-In</th><th>Check-Out</th><th>Room Type</th><th>Status</th></tr></thead>";
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['check_in'] . "</td>";
                                            echo "<td>" . $row['check_out'] . "</td>";
                                            echo "<td>" . $row['room_type'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    } else {
                                        echo "<p>No booking history available.</p>";
                                    }

                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "<div class='error-message'>Failed to fetch booking history. Please try again.</div>";
                                }

                                mysqli_close($conn);
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</body>

</html>