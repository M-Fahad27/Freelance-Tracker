<?php
// Database connection
$host = "localhost"; // change if necessary
$dbname = "freelance"; // change to your database name
$username = "root"; // your db username
$password = ""; // your db password
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle SignUp POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
    if ($conn->query($sql) === TRUE) {
        $signupSuccess = "Signup Successful!";
    } else {
        $signupError = "Signup failed: " . $conn->error;
    }
}

// Handle Login POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: dashboard.php"); // Redirect to dashboard after successful login
        exit();
    } else {
        $loginError = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelance Tracker</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/1270dba9e7.js" crossorigin="anonymous"></script>
    <style>
        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #281c4c;
            color: #fff;
            padding: 15px 40px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        .navbar .logo {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
            font-family: "Lora", serif;
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            font-family: "Lora", serif;
        }
        .nav-links li {
            margin: 0 15px;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1em;
            transition: color 0.3s;
            font-family: "Lora", serif;
        }
        .nav-links a:hover {
            color: #9f87ff;
        }
        body {
            margin: 0;
            padding-top: 60px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Freelance Tracker</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="learnmore.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <div class="container right-panel-active" id="container">
        <div class="form-container sign-up-container">
            <form action="login.php" method="POST">
                <h1>Create Account</h1>
                
                <br>
                <input type="email" name="username" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button id="sign" type="submit" name="signup">Sign Up</button>
                <?php if (isset($signupSuccess)) echo "<div class='alert' id='aleert'>$signupSuccess</div>"; ?>
                <?php if (isset($signupError)) echo "<div class='alert' id='aleert'>$signupError</div>"; ?>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="login.php" method="POST">
                <h1>Sign in</h1>
                
                <br>
                <input id="email" name="username" type="text" placeholder="Email" />
                <input id="password" name="password" type="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
                <?php if (isset($loginError)) echo "<div class='alert' id='aleert'>$loginError</div>"; ?>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById("signUp");
        const signInButton = document.getElementById("signIn");
        const container = document.getElementById("container");
        const signButton = document.getElementById("sign");
        const alertDiv = document.getElementById("aleert");

        signUpButton.addEventListener("click", () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener("click", () => {
            container.classList.remove("right-panel-active");
        });

        signButton.addEventListener("click", (e) => {
            alertDiv.style.display = 'block';
        });
    </script>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
