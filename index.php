<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Project Tracker - Dashboard</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
/*            background: linear-gradient(135deg, #5a189a, #9d4edd);*/
background: url(comp.png)no-repeat ;
background-size: cover;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(0, 0, 0, 0.3); 
            padding: 15px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
             font-family: "Lora", serif;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 600;
            color: #fff !important;
             font-family: "Lora", serif;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            margin: 0 10px;
             font-family: "Lora", serif;
        }

        .navbar-nav .nav-link:hover {
            color:  #9f87ff !important;
        
        }

        /* Login and Signup Buttons */
        .btn-login, .btn-signup {
            font-size: 1rem;
            font-weight: 500;
            border-radius: 25px; 
            padding: 10px 20px;
            margin-left: 15px; 
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .qwe {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    border-radius: 3%;
    padding: 30px 40px;
    justify-content: flex-start;
    text-align: left; 
}

        .btn-login {
            background-color: #5a189a; 
            color: #ffffff;
            border: none;
        }

        .btn-login:hover {
            background-color: #9d4edd; 
            transform: translateY(-3px);
        }

        .btn-signup {
            background-color: #5a189a; 
            color: #ffffff;
            border: none;
        }

        .btn-signup:hover {
            background-color: #9d4edd; 
            transform: translateY(-3px);
        }

        
        .main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start; 
    justify-content: center;
    text-align: left;
    padding: 0 20px;
    margin-left: 5%; 
    animation: fadeIn 1.5s ease-in-out;
}

        .main-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .main-content p {
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .btn-custom {
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 30px;
            margin: 10px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-start {
            background-color: #5a189a;
            color: #ffffff;
            border: none;
        }

        .btn-start:hover {
            background-color: #ffc107;
            transform: translateY(-5px);
        }

        .btn-learn {
            background-color: transparent;
            color: #ffffff;
            border: 2px solid #ffffff;
        }

        .btn-learn:hover {
            background-color: #ffffff;
            color: #5a189a;
            transform: translateY(-5px);
        }

        
        .footer {
            text-align: center;
            font-size: 0.9rem;
            padding: 15px 0;
            background-color: rgba(0, 0, 0, 0.3);
        }

   
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Freelance Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="learnmore.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    
                  
                    <li class="nav-item">
                        <a class="btn btn-signup" href="login.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="main-content">
        <div class="qwe">
            <h1>Bring Clarity to<br> Your Freelance Projects</h1>
        <p >Manage your clients, track projects, and monitor payments seamlessly with Freelance Tracker.</p>
        </div>
        <div>
            <a href="login.php" class="btn btn-custom btn-start" style="position: relative; left: 170px;">Start Now</a>
            <a href="learnmore.php" class="btn btn-custom btn-learn" style="position: relative; left: 170px;" >Learn More</a>
        </div>
    </div>


    <footer class="footer">
        <p>&copy; 2024 Freelance Project Tracker. All rights reserved.</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
