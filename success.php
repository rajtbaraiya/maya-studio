<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<style>
    :root {
        --text-dark: #171717;
        --text-light: #525252;
        --white: #ffffff;
        --header-font: "Merriweather", serif;
    }

    body {
        font-family: "Montserrat", serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .success-container {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .success-box {
        background-color: var(--white);
        padding: 3rem;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 500px;
        width: 100%;
    }

    .success-box h1 {
        color: var(--text-dark);
        font-family: var(--header-font);
        margin-bottom: 1.5rem;
    }

    .success-box p {
        color: var(--text-light);
        margin-bottom: 2rem;
    }

    .success-box a {
        display: inline-block;
        padding: 10px 25px;
        background-color: #e80a84;
        color: var(--white);
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .success-box a:hover {
        background-color: var(--text-dark);
        color: var(--white);
    }
</style>
<body>
    <?php
    session_start();
    
    // Check if token exists and matches session token
    if (!isset($_GET['token']) || !isset($_SESSION['form_token']) || $_GET['token'] !== $_SESSION['form_token']) {
        header("Location: contact.php");
        exit();
    }
    
    // Clear the session token after verification
    unset($_SESSION['form_token']);
    ?>

    <div class="success-container">
        <div class="success-box">
            <h1>Message Sent Successfully!</h1>
            <p>Thank you for contacting us. We'll get back to you as soon as possible.</p>
            <a href="index.php">Return to Home</a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>