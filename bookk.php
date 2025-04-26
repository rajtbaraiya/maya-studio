<?php
session_start();
include("config.php");

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: ../login system with avatar/login.php");
    exit();
}

// Check if bookings table exists
$check_table = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($check_table->num_rows == 0) {
    // Create bookings table if it doesn't exist
    $create_table_sql = file_get_contents(__DIR__ . '/database/create_bookings_table.sql');
    if ($conn->multi_query($create_table_sql)) {
        do {
            // Process each result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        die("Error creating bookings table: " . $conn->error);
    }
}

$error = '';
$success = '';
$preselected_package = isset($_GET['package']) ? $_GET['package'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];
    $package = $_POST['package'];
    
    // Define package prices
    $package_prices = [
        'basic' => 1499.00,
        'standard' => 2499.00,
        'premium' => 3499.00
    ];
    
    $amount = $package_prices[$package];

    // Begin transaction
    $conn->begin_transaction();
    try {
        // Insert booking into bookings table
        $sql = "INSERT INTO bookings (user_id, full_name, email, phone, preferred_date, preferred_time, service, package, amount) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("isssssssd", $_SESSION['uid'], $name, $email, $phone, $date, $time, $service, $package, $amount);
        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
        $booking_id = $conn->insert_id;
        $stmt->close();

        // Commit transaction
        $conn->commit();

        // Set success message and redirect
        $_SESSION['booking_success'] = true;
        header("Location: payment.php?booking_id=" . $booking_id . "&amount=" . $amount);
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $error = "Error: " . $e->getMessage();
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-WITH-HIRAJAT | BOOKING-PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>
        /* [Your existing CSS remains unchanged] */
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        :root {
            --primary-dark: #2d2d2d;
            --secondary-dark: #4a4a4a;
            --accent-color: #f4a261;
            --light-bg: #f9f9f9;
            --white: #ffffff;
            --error-color: #e63946;
            --success-color: #2a9d8f;
            --max-width: 1200px;
            --header-font: "Merriweather", serif;
            --body-font: "Montserrat", sans-serif;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--body-font);
            background-color: var(--light-bg);
            line-height: 1.6;
        }

        .booking-section {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url('https://images.unsplash.com/photo-1519750157634-b6d493a0f77c?auto=format&fit=crop&q=80') 
                        center/cover no-repeat;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .booking-container {
            background: rgba(255, 255, 255, 0.95);
            max-width: 650px;
            width: 100%;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            animation: fadeInUp 1s ease-in-out;
        }

        .booking-container h2 {
            font-family: var(--header-font);
            font-size: 2.5rem;
            color: var(--primary-dark);
            text-align: center;
            margin-bottom: 10px;
        }

        .booking-container .subtitle {
            text-align: center;
            color: var(--secondary-dark);
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .booking-form {
            display: grid;
            gap: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
            font-family: var(--body-font);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 8px rgba(244, 162, 97, 0.3);
        }

        .form-group select {
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="%234a4a4a" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 16px center;
        }

        .form-group.error input,
        .form-group.error select {
            border-color: var(--error-color);
            box-shadow: 0 0 8px rgba(230, 57, 70, 0.2);
        }

        .form-group.success input,
        .form-group.success select {
            border-color: var(--success-color);
        }

        .form-group .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
            position: absolute;
            bottom: -22px;
            left: 0;
        }

        .form-group.error .error-message {
            display: block;
        }

        .submit-btn {
            background: var(--accent-color);
            color: var(--white);
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            background: #e68a41;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244, 162, 97, 0.4);
        }

        .submit-btn::after {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            top: -50%;
            left: -50%;
            transform: rotate(30deg);
            transition: all 0.5s ease;
        }

        .submit-btn:hover::after {
            left: 150%;
        }

        .booking-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .booking-container {
                margin: 20px;
                padding: 35px;
            }
            
            .booking-container h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .booking-container {
                padding: 25px;
            }
            
            .submit-btn {
                padding: 12px;
            }
        }

        .error-message {
            color: #e63946;
            background-color: #ffd7d7;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none;
        }
        .form-error {
            background-color: #e63946;
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .logo {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        .logo img {
            width: 150px;
            height: auto;
            transition: transform 0.3s ease;
        }
        
        .logo img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<a href="index.php" class="logo">
    <img src="assets/images/logo.jpg" alt="Maya Studio Logo">
</a>

    <div style="text-align: right; padding: 20px;">
        <a href="my-bookings.php" class="btn" style="background-color: #f4a261; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">My Bookings</a>
    </div>

    <?php if ($error): ?>
    <div class="form-error">
        <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>

    <section class="booking-section">
        <div class="booking-container">
            <h2>Book Your Photoshoot</h2>
            <p class="subtitle">Let's capture your perfect moments</p>
            <form class="booking-form" id="bookingForm" method="post" novalidate>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name">
                    <span class="error-message">Please enter a valid name (min 2 characters)</span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                    <span class="error-message">Please enter a valid email address</span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
                    <span class="error-message">Please enter a valid phone number</span>
                </div>

                <div class="form-group">
                    <label for="date">Preferred Date</label>
                    <input type="date" id="date" name="date" required>
                    <span class="error-message">Please select a future date</span>
                </div>

                <div class="form-group">
                    <label for="time">Preferred Time</label>
                    <input type="time" id="time" name="time" required>
                    <span class="error-message">Please select a time</span>
                </div>

                <div class="form-group">
                    <label for="service">Photography Service</label>
                    <select id="service" name="service" required>
                        <option value="" disabled selected>Select a service</option>
                        <option value="wedding">Wedding Photography</option>
                        <option value="pre-wedding">Pre-wedding Photography</option>
                        <option value="portrait">Portrait Photography</option>
                        <option value="family">Family Photography</option>
                        <option value="maternity">Maternity Photography</option>
                        <option value="newborn">Newborn Photography</option>
                        <option value="wild">Wildlife Photography</option>
                        <option value="modeling">Modeling Photography</option>
                        <option value="product">Product Photography</option>
                    </select>
                    <span class="error-message">Please select a service</span>
                </div>

                <div class="form-group">
                    <label for="package">Package Type</label>
                    <select id="package" name="package" required>
                        <option value="" disabled <?php echo $preselected_package === '' ? 'selected' : ''; ?>>Select a package</option>
                        <option value="basic" <?php echo $preselected_package === 'basic' ? 'selected' : ''; ?>>Basic Package - ₹1499</option>
                        <option value="standard" <?php echo $preselected_package === 'standard' ? 'selected' : ''; ?>>Standard Package - ₹2499</option>
                        <option value="premium" <?php echo $preselected_package === 'premium' ? 'selected' : ''; ?>>Premium Package - ₹3499</option>
                    </select>
                    <span class="error-message">Please select a package</span>
                </div>

                <button type="submit" class="submit-btn">Book Now</button>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Reset previous validation states
            const formGroups = this.querySelectorAll('.form-group');
            formGroups.forEach(group => {
                group.classList.remove('error', 'success');
            });

            // Name validation
            const name = this.querySelector('#name');
            if (name.value.trim().length < 2) {
                name.parentElement.classList.add('error');
                isValid = false;
            } else {
                name.parentElement.classList.add('success');
            }

            // Email validation
            const email = this.querySelector('#email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.parentElement.classList.add('error');
                isValid = false;
            } else {
                email.parentElement.classList.add('success');
            }

            // Phone validation
            const phone = this.querySelector('#phone');
            const phoneRegex = /^\+?[\d\s-]{10,}$/;
            if (!phoneRegex.test(phone.value)) {
                phone.parentElement.classList.add('error');
                isValid = false;
            } else {
                phone.parentElement.classList.add('success');
            }

            // Date validation
            const date = this.querySelector('#date');
            const selectedDate = new Date(date.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (!date.value || selectedDate < today) {
                date.parentElement.classList.add('error');
                isValid = false;
            } else {
                date.parentElement.classList.add('success');
            }

            // Time validation
            const time = this.querySelector('#time');
            if (!time.value) {
                time.parentElement.classList.add('error');
                isValid = false;
            } else {
                time.parentElement.classList.add('success');
            }

            // Service validation
            const service = this.querySelector('#service');
            if (!service.value) {
                service.parentElement.classList.add('error');
                isValid = false;
            } else {
                service.parentElement.classList.add('success');
            }

            // Package validation
            const pkg = this.querySelector('#package');
            if (!pkg.value) {
                pkg.parentElement.classList.add('error');
                isValid = false;
            } else {
                pkg.parentElement.classList.add('success');
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Real-time validation
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.parentElement.classList.remove('error', 'success');
            });
        });
    </script>
</body>
</html>