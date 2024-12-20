<?php
// Database connection settings
$host = 'localhost';
$db = 'freelance';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

// Establish the database connection
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch payment data from the database
function fetchPayments($pdo) {
    $sql = "SELECT * FROM payments";
    $stmt = $pdo->query($sql);
    $payments = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $payments[] = $row;
    }

    return $payments;
}

// Check if the request is to fetch payments as JSON
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'fetchPayments') {
    header('Content-Type: application/json');
    echo json_encode(fetchPayments($pdo));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lora", serif;
        }

        body {
            background: url('signup.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
            margin: 0;
            padding: 0;
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

        .btn-signup {
            font-size: 1rem;
            font-weight: 500;
            border-radius: 25px;
            padding: 10px 20px;
            margin-left: 15px;
            background-color: #5a189a;
            color: #ffffff;
            border: none;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-signup:hover {
            background-color: #9d4edd;
            transform: translateY(-3px);
        }

        .container {
            margin: 100px auto 50px;
            max-width: 1200px;
            padding: 20px;
            background: #2d046e;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #e6e6fa;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 8px;
        }

        table, th, td {
            border: 1px solid #5a189a;
        }

        th {
            background: #502ca7;
            color: #fff;
            text-transform: uppercase;
            padding: 15px;
            font-size: 1rem;
        }

        td {
            padding: 12px;
            font-size: 0.95rem;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #401c79;
        }

        tr:nth-child(odd) {
            background: #472e8b;
        }

        .loading {
            text-align: center;
            font-size: 1.2rem;
            color: #e6e6fa;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            color: #f5f5f5;
            font-size: 1.1rem;
        }

        tbody tr:hover {
            background: #5e34a3;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .return-button {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            background: #502ca7;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .return-button:hover {
            background: #6d3ecb;
            transform: scale(1.05);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            fetchPayments();

            function fetchPayments() {
                $("#paymentTable tbody").html('<tr><td colspan="5" class="loading">Loading...</td></tr>');

                $.ajax({
                    url: "viewpayment.php?action=fetchPayments",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        var rows = "";
                        if (data.length > 0) {
                            data.forEach(function (payment) {
                                rows += "<tr>" +
                                    "<td>" + payment.projectName + "</td>" +
                                    "<td>" + payment.clientName + "</td>" +
                                    "<td>" + payment.amountPaid + "</td>" +
                                    "<td>" + payment.paymentDate + "</td>" +
                                    "<td>" + payment.paymentMethod + "</td>" +
                                    "</tr>";
                            });
                        } else {
                            rows = '<tr><td colspan="5" class="no-data">No payments found</td></tr>';
                        }
                        $("#paymentTable tbody").html(rows);
                    },
                    error: function () {
                        $("#paymentTable tbody").html('<tr><td colspan="5" class="loading">Error fetching data</td></tr>');
                    }
                });
            }
        });
    </script>
</head>
<body>
    <div class="navbar">
        <h1>Freelance Tracker</h1>
        <div>
            <a href="dashboard.php">Home</a>
            <a href="viewclient.php">Clients</a>
            <a href="Viewproject.php">Projects</a>
            <a href="viewpayment.php">Payments</a>
            <a href="index.php" class="btn-signup">Log out</a>
        </div>
    </div>

    <div class="container">
        <h1>Payment List</h1>
        <table id="paymentTable">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>Amount Paid</th>
                    <th>Payment Date</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here -->
            </tbody>
        </table>
        <a href="dashboard.php" class="return-button">Return to Dashboard</a>
    </div>
</body>
</html>
