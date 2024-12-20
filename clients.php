<?php
// Database connection setup
$servername = "localhost"; // Your MySQL server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "freelance"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientName = $_POST['clientName'];
    $clientEmail = $_POST['clientEmail'];
    $clientPhone = $_POST['clientPhone'];
    $clientAddress = $_POST['clientAddress'];

    // Validate input
    if (empty($clientName) || empty($clientEmail) || empty($clientPhone) || empty($clientAddress)) {
        $error = "All fields are required";
    } else {
        // Insert into databasem
        $sql = "INSERT INTO clients (clientName, clientEmail, clientPhone, clientAddress) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $clientName, $clientEmail, $clientPhone, $clientAddress);

            if ($stmt->execute()) {
                $success = "Client added successfully!";
            } else {
                $error = "Error adding client";
            }

            $stmt->close();
        } else {
            $error = "Database error";
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Client</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lora", serif;
        }
        body {
            display: flex;
            flex-direction: column;
            background: url(signup.jpg); 
            background-size: cover;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background:#281c4c;
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
        .box {
            width: 420px; 
            text-align: center;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(255, 255, 255, .2);
            border-radius: 10%;
            padding: 30px 40px;
            margin-top: 100px; 
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease forwards;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 5px;
            text-align: left;
            display: block;
        }
        .form-group input {
            width: 100%; 
            height: 50px; 
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: black;
            padding: 0 20px;
            background: whitesmoke;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-group input::placeholder {
            color:black;
        }
        .form-group input:focus {
            border-color: #ffd700;
            box-shadow: 0 0 8px #ffd700;
        }
        .btn {
            width: 100%; 
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            background: #fff;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            font-size: 16px;
            color: #333;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .btn:hover {
            background: #ffd700;
            transform: translateY(-2px);
        }
        .register {
            font-size: 14.5px;
            color: #fff;
            text-align: center;
            margin: 20px 0 15px;
        }
        .register p a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .register p a:hover {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Freelance Tracker</h1>
        <div>
            <a href="dashboard.php">Home</a>
            <a href="viewclient.php">Clients</a>
            <a href="viewproject.php">Projects</a>
            <a href="viewpayment.php">Payments</a>
            <a href="index.php" class="btn-signup">Log out</a>
        </div>
    </div>

    <div class="box">
        <h1>Add New Client</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <form action="Clients.php" method="post">
            <div class="form-group">
                <label for="clientName">Client Name</label>
                <input type="text" id="clientName" name="clientName" placeholder="Enter Client Name" required>
            </div>
            <div class="form-group">
                <label for="clientEmail">Client Email</label>
                <input type="email" id="clientEmail" name="clientEmail" placeholder="Enter Client Email" required>
            </div>
            <div class="form-group">
                <label for="clientPhone">Client Phone</label>
                <input type="text" id="clientPhone" name="clientPhone" placeholder="Enter Client Phone" required>
            </div>
            <div class="form-group">
                <label for="clientAddress">Client Address</label>
                <input type="text" id="clientAddress" name="clientAddress" placeholder="Enter Client Address" required>
            </div>
            <button class="btn" type="submit">Add Client</button>
        </form>
        <div class="register">
            <p>Want to view all clients? <a href="viewclient.php">View Clients</a></p>
        </div>
    </div>
</body>
</html>
