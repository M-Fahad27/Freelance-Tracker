<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - Freelance Tracker</title>
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
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

        .qwe {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            border-radius: 3%;
            padding: 30px 40px;
            justify-content: center;
            text-align: center;
        }

        .content {
            margin-top: 50px;
            max-width: 800px;
            text-align: center;
            flex-grow: 1; 
        }

        .content h1 {
            font-size: 2.5rem;
            color: #a64dff;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .btn-custom {
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
            <a href="learnmore.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="login.php" class="cta-button">Sign Up</a>
        </div>
    </div>
    <br><br><br><br>
    <div class="content">
        <div class="qwe">
            <h1>Learn More About Freelance Tracker</h1>
            <p>
                Freelance Tracker is a robust platform designed to help freelancers manage their work more effectively. 
                From managing client information to tracking payments and projects, it provides a centralized system 
                for ensuring all your tasks are organized.
            </p>
            <p>
                The platform includes features such as client tracking, project updates, payment summaries, and detailed analytics 
                to help freelancers stay on top of their workload. Whether you're just starting out or are an experienced freelancer, 
                Freelance Tracker is the tool you need to streamline your workflow.
            </p>
            <a class="btn-custom" href="index.php">Back to Home</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Freelance Tracker. All Rights Reserved. <a href="contact.php">Contact Us</a></p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
