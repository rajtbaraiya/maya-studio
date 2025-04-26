<?php
session_start();
include("../../login system with avatar/config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$error = null;
$success = null;
$bookings = [];

// Handle status update
if (isset($_POST['update_status'])) {
    $booking_id = $_POST['booking_id'];
    $new_status = $_POST['status'];
    
    if ($new_status === 'cancelled') {
        // Get booking details before cancellation
        $get_booking = "SELECT amount, user_id, is_refunded FROM bookings WHERE id = ?";
        $stmt = $conn->prepare($get_booking);
        if ($stmt) {
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $booking_result = $stmt->get_result();
            if ($booking_row = $booking_result->fetch_assoc()) {
                if (!$booking_row['is_refunded']) {
                    // Process refund
                    $amount = $booking_row['amount'];
                    $user_id = $booking_row['user_id'];
                    
                    // Update user's wallet/balance
                    $update_user = "UPDATE user_form SET wallet_balance = wallet_balance + ? WHERE id = ?";
                    $stmt_user = $conn->prepare($update_user);
                    if ($stmt_user) {
                        $stmt_user->bind_param("di", $amount, $user_id);
                        if ($stmt_user->execute()) {
                            // Mark booking as refunded
                            $update_booking = "UPDATE bookings SET status = ?, is_refunded = 1 WHERE id = ?";
                            $stmt_booking = $conn->prepare($update_booking);
                            if ($stmt_booking) {
                                $stmt_booking->bind_param("si", $new_status, $booking_id);
                                if ($stmt_booking->execute()) {
                                    $success = "Booking cancelled and amount refunded successfully";
                                } else {
                                    $error = "Error updating booking status: " . $stmt_booking->error;
                                }
                            }
                        } else {
                            $error = "Error processing refund: " . $stmt_user->error;
                        }
                    }
                }
            }
        }
    } else {
        // Normal status update for non-cancellation cases
        $sql = "UPDATE bookings SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("si", $new_status, $booking_id);
            if ($stmt->execute()) {
                $success = "Booking status updated successfully";
            } else {
                $error = "Error updating status: " . $stmt->error;
            }
        }
    }
}

// Handle deletion
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            header("Location: dashboard.php?msg=deleted");
            exit();
        } else {
            $error = "Error deleting booking: " . $stmt->error;
        }
    }
}

// Get booking statistics
$stats = [
    'total' => 0,
    'pending' => 0,
    'confirmed' => 0,
    'cancelled' => 0,
    'total_amount' => 0,
    'total_users' => 0
];

// Get booking stats
$sql = "SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled,
            SUM(CASE WHEN status != 'cancelled' THEN amount ELSE 0 END) as total_amount
        FROM bookings";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $stats = $row;
}

// Get user count
$user_count = $conn->query("SELECT COUNT(*) as count FROM user_form");
if($user_count) {
    $count = $user_count->fetch_assoc();
    $stats['total_users'] = $count['count'];
}

// Get all bookings
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result === false) {
    $error = "Error querying database: " . $conn->error;
} else {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// Get all users for user management
$users = [];
$user_result = $conn->query("SELECT * FROM user_form ORDER BY id DESC");
if($user_result) {
    while($row = $user_result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maya Studio Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        :root {
            --primary: #2d2d2d;
            --secondary: #4a4a4a;
            --accent: #f4a261;
            --light: #f9f9f9;
            --white: #ffffff;
            --success: #2a9d8f;
            --warning: #e9c46a;
            --danger: #e63946;
            --gray: #6c757d;
            --border: #dee2e6;
            --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .dashboard-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            font-size: 1rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
        }

        .stat-card .value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary);
        }

        .stat-card.pending .value { color: var(--warning); }
        .stat-card.confirmed .value { color: var(--success); }
        .stat-card.cancelled .value { color: var(--danger); }
        .stat-card.total .value { color: var(--accent); }

        .search-box {
            background: var(--white);
            padding: 1rem;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent);
        }

        .bookings-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .bookings-table th,
        .bookings-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .bookings-table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        .bookings-table tr:last-child td {
            border-bottom: none;
        }

        .bookings-table tbody tr {
            transition: background-color 0.3s ease;
        }

        .bookings-table tbody tr:hover {
            background-color: rgba(244, 162, 97, 0.1);
        }

        .status {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            text-transform: capitalize;
        }

        .status-pending {
            background-color: var(--warning);
            color: var(--primary);
        }

        .status-confirmed {
            background-color: var(--success);
            color: var(--white);
        }

        .status-cancelled {
            background-color: var(--danger);
            color: var(--white);
        }

        .amount {
            font-weight: 600;
            color: var(--accent);
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--accent);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #f28b4b;
        }

        .btn-danger {
            background-color: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #dc2f3c;
        }

        .success-message {
            background-color: var(--success);
            color: var(--white);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
            animation: slideDown 0.3s ease;
        }

        .error-message {
            background-color: var(--danger);
            color: var(--white);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
            animation: slideDown 0.3s ease;
        }

        .status-select {
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 0.875rem;
            background-color: var(--white);
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .status-select:focus {
            outline: none;
            border-color: var(--accent);
        }

        /* Navigation Menu Styles */
        .admin-nav {
            background: var(--primary);
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 8px;
        }

        .admin-nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .admin-nav a {
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .admin-nav a:hover {
            background-color: var(--secondary);
        }

        .admin-nav a.active {
            background-color: var(--accent);
        }

        @keyframes slideDown {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .bookings-table {
                display: block;
                overflow-x: auto;
            }
        }

        /* User Management Table Styles */
        .user-management {
            margin-top: 40px;
            background: var(--white);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .user-table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .user-table tr:hover {
            background-color: var(--light);
        }

        .delete-user-btn {
            background-color: var(--danger);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-user-btn:hover {
            background-color: #dc2f3c;
        }

        .section-title {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent);
        }

        /* User Management Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 1000px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close {
            color: var(--gray);
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: var(--primary);
        }

        .manage-users-btn {
            background-color: var(--accent);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            margin: 20px 0;
        }

        .manage-users-btn:hover {
            background-color: #f28b4b;
        }

        /* User Table Styles */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .user-table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 500;
        }

        .user-table tr:hover {
            background-color: var(--light);
        }

        .delete-user-btn {
            background-color: var(--danger);
            color: var(--white);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .delete-user-btn:hover {
            background-color: #dc2f3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h1>Maya Studio Dashboard</h1>
            <p>Manage all your bookings in one place</p>
        </div>

        <nav class="admin-nav">
            <ul>
                <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a></li>
                <li><a href="share_photos.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'share_photos.php' ? 'active' : ''; ?>">Share Photos</a></li>
                <li><a href="gallery.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">Manage Gallery</a></li>
                <li><a href="photo_requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'photo_requests.php' ? 'active' : ''; ?>">Photo Requests</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="stats-container">
            <div class="stat-card total">
                <h3>Total Bookings</h3>
                <div class="value"><?php echo $stats['total'] ?? 0; ?></div>
            </div>
            <div class="stat-card pending">
                <h3>Pending Bookings</h3>
                <div class="value"><?php echo $stats['pending'] ?? 0; ?></div>
            </div>
            <div class="stat-card confirmed">
                <h3>Confirmed Bookings</h3>
                <div class="value"><?php echo $stats['confirmed'] ?? 0; ?></div>
            </div>
            <div class="stat-card cancelled">
                <h3>Cancelled Bookings</h3>
                <div class="value"><?php echo $stats['cancelled'] ?? 0; ?></div>
            </div>
            <div class="stat-card">
                <i class="ri-money-dollar-circle-line"></i>
                <h3>Total Revenue</h3>
                <div class="value">₹<?php echo number_format($stats['total_amount'] ?? 0, 2); ?></div>
            </div>
            <div class="stat-card">
                <i class="ri-message-2-line"></i>
                <h3>Contact Messages</h3>
                <div class="value">
                    <?php
                    $contact_count = $conn->query("SELECT COUNT(*) as count FROM contact")->fetch_assoc();
                    echo $contact_count['count'] ?? 0;
                    ?>
                </div>
            </div>
        </div>

        <div class="quick-actions mt-4">
            <button class="manage-users-btn" onclick="openUserManagement()">
                <i class="ri-user-settings-line"></i> Manage Users
            </button>
            <a href="photo_requests.php" class="btn btn-primary me-2">
                <i class="ri-image-line"></i> Photo Requests
            </a>
            <a href="view_contacts.php" class="btn btn-primary">
                <i class="ri-message-2-line"></i> View Contact Messages
            </a>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="success-message">Booking has been successfully deleted.</div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by name, email, or phone..." onkeyup="searchTable()">
        </div>

        <!-- User Management Modal -->
        <div id="userManagementModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeUserManagement()">&times;</span>
                <h2>User Management</h2>
                <?php if(count($users) > 0): ?>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <button class="delete-user-btn" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                            Delete User
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No users found</p>
                <?php endif; ?>
            </div>
        </div>

        <table class="bookings-table" id="bookingsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Package</th>
                    <th>Date & Time</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td>#<?php echo $booking['id']; ?></td>
                    <td><?php echo $booking['full_name']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['phone']; ?></td>
                    <td><?php echo $booking['service']; ?></td>
                    <td><?php echo $booking['package']; ?></td>
                    <td>
                        <?php 
                        echo date('d M Y', strtotime($booking['preferred_date'])) . '<br>';
                        echo date('h:i A', strtotime($booking['preferred_time']));
                        ?>
                    </td>
                    <td class="amount">₹<?php echo number_format($booking['amount'], 2); ?></td>
                    <td>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                            <select name="status" class="status-select" onchange="this.form.submit()">
                                <option value="pending" <?php echo ($booking['status'] ?? 'pending') == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="confirmed" <?php echo ($booking['status'] ?? '') == 'confirmed' ? 'selected' : ''; ?>>Confirm</option>
                                <option value="cancelled" <?php echo ($booking['status'] ?? '') == 'cancelled' ? 'selected' : ''; ?>>Cancel</option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary" 
                           onclick="showDetails('<?php 
                               echo htmlspecialchars(json_encode([
                                   'name' => $booking['full_name'],
                                   'email' => $booking['email'],
                                   'phone' => $booking['phone'],
                                   'service' => $booking['service'],
                                   'package' => $booking['package'],
                                   'date' => date('d M Y', strtotime($booking['preferred_date'])),
                                   'time' => date('h:i A', strtotime($booking['preferred_time'])),
                                   'amount' => number_format($booking['amount'], 2),
                                   'status' => $booking['status'] ?? 'pending',
                                   'created' => date('d M Y h:i A', strtotime($booking['created_at']))
                               ]), JSON_HEX_APOS | JSON_HEX_QUOT); 
                           ?>')">View</a>
                        <a href="?delete=<?php echo $booking['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    // User Management Modal Functions
    function openUserManagement() {
        document.getElementById('userManagementModal').style.display = 'block';
    }

    function closeUserManagement() {
        document.getElementById('userManagementModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('userManagementModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    function deleteUser(userId) {
        if(confirm('Are you sure you want to delete this user?')) {
            fetch('../delete_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_id=' + userId
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('User deleted successfully!');
                    location.reload();
                } else {
                    alert('Error deleting user: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the user');
            });
        }
    }

    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('bookingsTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let j = 1; j < 4; j++) { // Search in name, email, phone columns
                const cell = cells[j];
                if (cell) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            row.style.display = found ? '' : 'none';
        }
    }

    function showDetails(bookingData) {
        const data = JSON.parse(bookingData);
        const message = `Booking Details:
            \nCustomer Name: ${data.name}
            \nEmail: ${data.email}
            \nPhone: ${data.phone}
            \nService: ${data.service}
            \nPackage: ${data.package}
            \nPreferred Date: ${data.date}
            \nPreferred Time: ${data.time}
            \nAmount: ₹${data.amount}
            \nStatus: ${data.status}
            \nBooked On: ${data.created}`;
        alert(message);
    }
    </script>
</body>
</html>
