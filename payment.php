<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* [Reuse CSS from the provided payment page] */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .total {
            font-size: 1.5em;
            color: #e74c3c;
            font-weight: bold;
            margin: 20px 0;
        }
        .payment-options {
            margin-top: 30px;
            text-align: left;
        }
        .payment-option {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: #f9f9f9;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .payment-option:hover {
            background: #e6e6e6;
        }
        .payment-option input[type="radio"] {
            margin-right: 10px;
        }
        .payment-option i {
            margin-right: 10px;
            color: #555;
        }
        .payment-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 5px;
        }
        .payment-details input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 20px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-shopping-cart"></i> Payment Page</h1>
        <div class="total">
            <?php 
                include("config.php");
                session_start();

                if (!isset($_SESSION['uid'])) {
                    header("Location: login.php");
                    exit();
                }

                $booking_id = $_GET['booking_id'] ?? 0;
                $total = $_GET['amount'] ?? 0;

                if ($total == 0 || $booking_id == 0) {
                    echo "Invalid payment details.";
                    exit();
                }

                echo "Total: ₹ " . number_format($total, 2);

                if (isset($_POST['pay_now'])) {
                    $conn->begin_transaction();
                    try {
                        $payment_status = 'success';
                        $payment_method = $_POST['payment'] ?? 'cod';
                        $pay_date = date('Y-m-d H:i:s');

                        // Insert into payments table (unchanged structure)
                        $sql = "INSERT INTO payments (U_ID, E_ID, Amount, Pay_Status, Method, Pay_date) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iidsds", $_SESSION['uid'], $booking_id, $total, $payment_status, $payment_method, $pay_date);
                        $stmt->execute();
                        $stmt->close();

                        $conn->commit();

                        header("Location: payment_confirmation.php?status=$payment_status&booking_id=$booking_id");
                        exit();
                    } catch (Exception $e) {
                        $conn->rollback();
                        error_log("Payment failed: " . $e->getMessage());
                        echo "<script>alert('Payment failed: " . addslashes($e->getMessage()) . "');</script>";
                    }
                }
            ?>
        </div>

        <div class="payment-options">
            <h2>Select Payment Method</h2>
            <form id="payment-form" action="" method="post">
                <div class="payment-option">
                    <input type="radio" name="payment" value="upi" id="upi-option">
                    <label for="upi-option"><i class="fas fa-mobile-alt"></i> UPI</label>
                </div>
                <div id="upi-input" class="payment-details">
                    <input type="text" id="upi-id" name="upi_id" placeholder="Enter UPI ID (e.g., name@upi)">
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="card" id="card-option">
                    <label for="card-option"><i class="fas fa-credit-card"></i> Credit/Debit Card</label>
                </div>
                <div id="card-input" class="payment-details">
                    <input type="text" name="card_number" placeholder="Card Number">
                    <input type="text" name="card_expiry" placeholder="MM/YY">
                    <input type="text" name="card_cvv" placeholder="CVV">
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="netbanking" id="netbanking-option">
                    <label for="netbanking-option"><i class="fas fa-university"></i> Net Banking</label>
                </div>
                <div id="netbanking-input" class="payment-details">
                    <select name="bank">
                        <option value="">Select Bank</option>
                        <option value="sbi">State Bank of India</option>
                        <option value="hdfc">HDFC Bank</option>
                        <option value="icici">ICICI Bank</option>
                    </select>
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="wallet" id="wallet-option">
                    <label for="wallet-option"><i class="fas fa-wallet"></i> Digital Wallet</label>
                </div>
                <div id="wallet-input" class="payment-details">
                    <select name="wallet">
                        <option value="">Select Wallet</option>
                        <option value="paytm">Paytm</option>
                        <option value="phonepe">PhonePe</option>
                        <option value="googlepay">Google Pay</option>
                    </select>
                </div>

                <div class="payment-option">
                    <input type="radio" name="payment" value="cod" id="cod-option" checked>
                    <label for="cod-option"><i class="fas fa-money-bill-wave"></i> Cash</label>
                </div>

                <button type="submit" id="confirm-payment" name="pay_now">Confirm Payment</button>
            </form>
        </div>
    </div>

    <script>
        const paymentOptions = document.querySelectorAll('input[name="payment"]');
        const paymentDetails = document.querySelectorAll('.payment-details');
        const confirmPayment = document.getElementById('confirm-payment');
        const paymentForm = document.getElementById('payment-form');

        paymentOptions.forEach(option => {
            option.addEventListener('change', () => {
                paymentDetails.forEach(detail => detail.style.display = 'none');
                const selectedOption = document.querySelector(`#${option.id.replace('-option', '')}-input`);
                if (selectedOption) selectedOption.style.display = 'block';
            });
        });

        paymentForm.addEventListener('submit', (e) => {
            const selectedPayment = document.querySelector('input[name="payment"]:checked').value;
            if (selectedPayment === 'upi' && !document.querySelector('#upi-id').value.trim()) {
                alert('Please enter your UPI ID.');
                e.preventDefault();
            } else if (selectedPayment === 'card') {
                const cardNumber = document.querySelector('input[name="card_number"]').value.trim();
                const cardExpiry = document.querySelector('input[name="card_expiry"]').value.trim();
                const cardCvv = document.querySelector('input[name="card_cvv"]').value.trim();
                if (!cardNumber || !cardExpiry || !cardCvv) {
                    alert('Please fill in all card details.');
                    e.preventDefault();
                }
            } else if (selectedPayment === 'netbanking' && !document.querySelector('select[name="bank"]').value) {
                alert('Please select a bank.');
                e.preventDefault();
            } else if (selectedPayment === 'wallet' && !document.querySelector('select[name="wallet"]').value) {
                alert('Please select a wallet.');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>