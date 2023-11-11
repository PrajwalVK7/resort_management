<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php"); 
    exit();
}

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['booking_id'])) {
    $action = $_POST['action'];
    $booking_id = $_POST['booking_id'];

    if ($action === 'accept' || $action === 'reject') {
        $new_status = ($action === 'accept') ? 'accepted' : 'rejected';

        $update_query = "UPDATE bookings SET status = ? WHERE booking_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $new_status, $booking_id);
            if (mysqli_stmt_execute($stmt)) {
                // Redirect back to the admin page after updating the status
                header("Location: admin.php");
            }
            mysqli_stmt_close($stmt);
        }
    }
}
$query = "SELECT b.booking_id, u.username, b.check_in, b.check_out,b.mob, b.guest, b.room_type, b.status FROM bookings b JOIN users u ON b.user_id = u.user_id";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
a{
    margin-left: 35%;
    font-size: 30px;
    text-decoration: none;
    color: white;
}
body{
    color: white;
}
table td tr{
    border: 1px solid black;
    background-color: aliceblue;
    color: black;
}
</style>
<body style="background-image: url('./images/banner3.jpg');">
    <h2 class=" container text-center mt-5 bg-black">Manage Bookings</h2>
    <div class="mt-5 d-flex justify-content-center">
        <?php

        if (mysqli_num_rows($result) > 0) {
            echo "<form method='post' action='admin.php'>
                <table>
                    <tr>
                        <th>Booking ID </th>
                        <th>User </th> 
                        <th>Check-In Date </th>
                        <th>Check-Out Date </th>
                        <th>Mobile Number </th>
                        <th>No of Guest </th>
                        <th>Room Type </th>
                        <th>Status </th>
                        <th>Action </th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $row['booking_id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['check_in'] . "</td>
                    <td>" . $row['check_out'] . "</td>
                    <td>" . $row['mob'] . "</td>
                    <td>" . $row['guest'] . "</td>
                    <td>" . $row['room_type'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td>
                        <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "'>
                        <button type='submit' name='action' value='accept'>Accept</button>
                        <button type='submit' name='action' value='reject'>Reject</button>
                    </td>
                </tr>";
            }

            echo "</table></form>";
        } else {
            echo "<span>No bookings found.</span>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <br>
    <a class="btn btn-warning" href="logout.php">Logout</a>
</body>

</html>