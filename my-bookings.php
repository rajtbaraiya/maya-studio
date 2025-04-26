<?php
session_start();
include("config.php");

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../login system with avatar/login.php");
    exit();
}

// Get user's bookings
$user_id = $_SESSION['uid'];
$error = null;
$bookings = [];

// First, check if bookings table exists
$check_table = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($check_table->num_rows == 0) {
    $error = "Bookings table does not exist. Please contact administrator.";
} else {
    // Get user's bookings with error handling
    $sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $error = "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            $error = "Error executing query: " . $stmt->error;
        } else {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Maya Studio</title>
    <style>
        :root {
            --primary-dark: #2d2d2d;
            --secondary-dark: #4a4a4a;
            --accent-color: #f4a261;
            --light-bg: #f9f9f9;
            --white: #ffffff;
            --pending: #ffd700;
            --confirmed: #2a9d8f;
            --cancelled: #e63946;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light-bg);
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: var(--primary-dark);
            margin-bottom: 30px;
            text-align: center;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bookings-table th {
            background-color: var(--primary-dark);
            color: var(--white);
            font-weight: 500;
        }

        .bookings-table tr:hover {
            background-color: #f5f5f5;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }

        .status-pending {
            background-color: var(--pending);
            color: var(--primary-dark);
        }

        .status-confirmed {
            background-color: var(--confirmed);
            color: var(--white);
        }

        .status-cancelled {
            background-color: var(--cancelled);
            color: var(--white);
        }

        .amount {
            font-weight: 600;
            color: var(--accent-color);
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--accent-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .no-bookings {
            text-align: center;
            padding: 40px;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            color: var(--secondary-dark);
        }

        .error-message {
            background-color: #e63946;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="bookk.php" class="back-btn">← Back to Booking</a>
        <h1>My Bookings</h1>

        <?php if ($error): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($error) && !empty($bookings)): ?>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Package</th>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['service']); ?></td>
                        <td><?php echo htmlspecialchars($booking['package']); ?></td>
                        <td>
                            <?php 
                            echo htmlspecialchars(date('d M Y', strtotime($booking['preferred_date']))) . '<br>';
                            echo htmlspecialchars(date('h:i A', strtotime($booking['preferred_time'])));
                            ?>
                        </td>
                        <td class="amount">₹<?php echo htmlspecialchars(number_format($booking['amount'], 2)); ?></td>
                        <td>
                            <span class="status status-<?php echo strtolower($booking['status'] ?? 'pending'); ?>">
                                <?php echo ucfirst($booking['status'] ?? 'Pending'); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (empty($error)): ?>
            <div class="no-bookings">
                <h3>No bookings found</h3>
                <p>You haven't made any bookings yet.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
