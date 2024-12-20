<?php
// Include database connection
include_once 'db_connection.php';

// Fetch clients and projects for the dropdowns
$clients = [];
$projects = [];
$conn = OpenCon();

$sqlClients = "SELECT clientName FROM clients";
$resultClients = $conn->query($sqlClients);
if ($resultClients->num_rows > 0) {
    while ($row = $resultClients->fetch_assoc()) {
        $clients[] = $row['clientName'];
    }
}

$sqlProjects = "SELECT projectName FROM projects";
$resultProjects = $conn->query($sqlProjects);
if ($resultProjects->num_rows > 0) {
    while ($row = $resultProjects->fetch_assoc()) {
        $projects[] = $row['projectName'];
    }
}

CloseCon($conn);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectName = $_POST['projectName'];
    $client = $_POST['client'];
    $amount = $_POST['amount'];
    $paymentDate = $_POST['paymentDate'];
    $paymentMethod = $_POST['paymentMethod'];

    $conn = OpenCon();
    $sql = "INSERT INTO payments (projectName, clientName, amountPaid, paymentDate, paymentMethod) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $projectName, $client, $amount, $paymentDate, $paymentMethod);

  
        if ($stmt->execute()) {
            $success = "Payment added successfully!";
        } else {
            $error = "Error adding Payment";
        }
   
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Payment</title>
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
        /* Add this to your existing CSS */
.navbar .btn-signup {
    text-decoration: none;
    background-color: #6a1b9a; /* Purple background */
    color: white; 
    padding: 10px 20px; 
    font-size: 1rem; 
    border-radius: 20px; 
    font-weight: bold; 
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.navbar .btn-signup:hover {
    background-color: #8e24aa; /* Slightly lighter purple on hover */
    transform: scale(1.05); 
}

        body {
            display: flex;
            flex-direction: column;
            background: url(signup.jpg);
            background-size: cover;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
      .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #281c4c;
            padding: 15px 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        .navbar h1 {
            color: white;
            font-size: 1.8rem;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            margin: 0;
        }
        .navbar a {
            text-decoration: none;
            color: white;
            font-family: "Lora", serif;
            font-size: 1rem;
            margin: 0 10px;
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
            animation: popUp 1.5s ease forwards;
        }
        @keyframes popUp {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .box h1 { color: #fff; margin-bottom: 20px; }
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
        .form-group input, .form-group select {
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
            transition: transform 0.3s ease-in-out;
        }
        .form-group input:hover, .form-group select:hover { transform: scale(1.05); }
        .form-group input::placeholder { color: black; }
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
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .btn:hover {
            background: #e0e0e0;
            transform: scale(1.1);
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
            position: relative;
        }
        .register p a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 1px;
            background: #fff;
            transition: width 0.3s ease-in-out;
        }
        .register p a:hover::after { width: 100%; }
        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            text-align: center;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Freelance Tracker</h1>
        <div>
            <a href="dashboard.php">Home</a>
            <a href="viewclient.php">Clients</a>
            <a href="viewprojects.php">Projects</a>
            <a href="viewpayment.php">Payments</a>
            <a href="index.php" class="btn-signup">Log out</a>
        </div>
    </div>

    <div class="box">
        <h1>Record Payment</h1>

        <!-- Display error or success messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="message error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['message'])): ?>
            <div class="message success"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <form action="payments.php" method="POST">
            <div class="form-group">
            <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
                <label for="projectDropdown">Project Name</label>
                <select id="projectDropdown" name="projectName" required>
                    <option value="" disabled selected>Select Project</option>
                    <?php foreach ($projects as $project): ?>
                        <option value="<?php echo $project; ?>"><?php echo $project; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="clientDropdown">Client Name</label>
                <select id="clientDropdown" name="client" required>
                    <option value="" disabled selected>Select Client</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client; ?>"><?php echo $client; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount Paid</label>
                <input type="number" id="amount" name="amount" placeholder="Enter Amount" required>
            </div>

            <div class="form-group">
                <label for="paymentDate">Payment Date</label>
                <input type="date" id="paymentDate" name="paymentDate" required>
            </div>

            <div class="form-group">
                <label for="paymentMethod">Payment Method</label>
                <select id="paymentMethod" name="paymentMethod" required>
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="cash">Cash</option>
                    <option value="credit">Credit Card</option>
                    <option value="bankTransfer">Bank Transfer</option>
                </select>
            </div>
            <button class="btn" type="submit">Add Payment</button>
        </form>

        <div class="register">
            <p>Want to view payment history? <a href="viewpayment.php">View Payments</a></p>
        </div>
    </div>
</body>
</html>