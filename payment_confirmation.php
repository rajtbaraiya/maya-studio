<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        .confirmation-container {
            text-align: center;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .checkmark {
            font-size: 80px;
            color: #28a745;
            opacity: 0;
            transform: translateX(-50px);
            animation: slideIn 1s ease-in-out forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .confirmation-text {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        .home-button {
            display: inline-block; /* Makes the button inline with proper spacing */
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .home-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="checkmark">✔</div>
        <div class="confirmation-text">Payment Successful</div>
        <a href="index.php" style="text-decoration: none; padding: 10px 20px; background-color: #4caf50; color: white; border-radius: 5px; display: inline-block;">Return to Home</a>
    </div>
</body>
</html>
