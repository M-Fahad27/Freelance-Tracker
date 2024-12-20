!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Freelance Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lora", serif;
        }
        body {
            background: url(comp.png); 
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: flex-start;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #281c4c;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar h1 {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-size: 1rem;
            margin-left: 30px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #9f87ff; 
        }

        .navbar .cta-button {
            text-decoration: none;
            background-color: #502ca7; 
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .navbar .cta-button:hover {
            background-color: #6d3ecb; 
            transform: scale(1.05); 
        }

        .contact-container {
            margin: 50px auto;
            max-width: 800px;
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            flex-grow: 1; 
        }
        .contact-container h1 {
            font-size: 2.5rem;
            color: #a64dff;
            margin-bottom: 20px;
        }
        .contact-container p {
            font-size: 1.2rem;
            line-height: 1.8;
        }
        .contact-details {
            margin-top: 20px;
            text-align: left;
        }
        .contact-details h3 {
            font-size: 1.5rem;
            color: #a64dff;
        }
        .contact-details p {
            margin: 5px 0;
            font-size: 1.1rem;
        }
        .btn-custom {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #a64dff;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #922cc6;
        }

        footer {
            text-align: center;
            font-size: 0.9rem;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.3);
            width: 100%;
            position: relative;
            bottom: 0;
        }

        footer a {
            color: #a64dff;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Freelance Tracker</h1>
        <div>
            <a href="index.php">Home</a>
            <a href="learnmore.php">About </a>
            <a href="contact.php">Contact</a>
            <a href="login.php" class="cta-button">Sign Up</a>
        </div>
    </div>
    <br><br><br><br>
    <div class="contact-container">
        <h1>Contact Us</h1>
        <p>We’d love to hear from you! Whether you have a question about our platform, need support, or just want to say hello, feel free to get in touch with us using the details below.</p>

        <div class="contact-details">
            <h3>Contact Information</h3>
            <p><strong>Email:</strong> muhammad.fahad1213@gmail.com</p>
            <p><strong>Phone:</strong> +92-349532-6867</p>
            <p><strong>Address:</strong> H-9, Numl University, Islamabad</p>
        </div>

        <a class="btn-custom" href="index.php">Back to Home</a>
    </div>

    <footer>
        <p>&copy; 2024 Freelance Tracker. All Rights Reserved. <a href="index.php">Home</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
