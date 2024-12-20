<?php
session_start();
// Set content type to JSON for AJAX requests
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'getDashboardData') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "freelance";  // Update with your DB name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching the required data
    $totalClientsQuery = "SELECT COUNT(*) AS totalClients FROM clients";
    $totalProjectsQuery = "SELECT COUNT(*) AS totalProjects FROM projects";
    $totalPaymentsQuery = "SELECT SUM(amountPaid) AS totalPayments FROM payments";
    $recentPaymentsQuery = "SELECT projectName, clientName, amountPaid, paymentDate, paymentMethod FROM payments ORDER BY paymentDate DESC LIMIT 10";

    // Initialize data
    $totalClients = 0;
    $totalProjects = 0;
    $totalPayments = 0.0;
    $recentPayments = [];

    if ($result = $conn->query($totalClientsQuery)) {
        $row = $result->fetch_assoc();
        $totalClients = $row['totalClients'];
    }

    if ($result = $conn->query($totalProjectsQuery)) {
        $row = $result->fetch_assoc();
        $totalProjects = $row['totalProjects'];
    }

    if ($result = $conn->query($totalPaymentsQuery)) {
        $row = $result->fetch_assoc();
        $totalPayments = $row['totalPayments'];
    }

    if ($result = $conn->query($recentPaymentsQuery)) {
        while ($row = $result->fetch_assoc()) {
            $recentPayments[] = [
                'projectName' => $row['projectName'],
                'clientName' => $row['clientName'],
                'amountPaid' => $row['amountPaid'],
                'paymentDate' => $row['paymentDate'],
                'paymentMethod' => $row['paymentMethod']
            ];
        }
    }

    // Prepare the response data
    $response = [
        'totalClients' => $totalClients,
        'totalProjects' => $totalProjects,
        'totalPayments' => $totalPayments,
        'recentPayments' => $recentPayments
    ];

    // Output JSON response
    echo json_encode($response);

    // Close the connection
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lora", serif;
        }
        body {
            background: url(signup.jpg);
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
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

        .dashboard {
            margin-top: 80px;
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .widget {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .widget:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }
        .widget h2 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 10px;
        }
        .widget .data {
            font-size: 2.5rem;
            color: #ffff; 
            font-weight: bold;
        }
        .widget p {
            color: #ddd;
            font-size: 1rem;
        }
        .widget a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #a64dff; 
            color: #fff;
            font-weight: bold;
            border-radius: 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .widget a:hover {
            background: #922cc6; 
        }
        .large-widget {
            grid-column: span 2;
        }
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            overflow: hidden;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            color: white;
        }
        table th {
            background: #a64dff; 
            color: white;
        }
        table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
           
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

    <div class="dashboard">
        <div class="widget">
            <h2>Total Clients</h2>
            <div class="data" id="totalClientsData">Loading...</div>
            <p>Number of clients working with you</p>
            <a href="clients.php">Add Clients</a>
        </div>

        <div class="widget">
            <h2>Total Projects</h2>
            <div class="data" id="totalProjectsData">Loading...</div>
            <p>Active and completed projects</p>
            <a href="projects.php">Add Projects</a>
        </div>
        
        <div class="widget large-widget">
            <h2>Payment Summary</h2>
            <p>Total Payments Received: <span class="data" id="totalPaymentsData">$0.00</span></p>
            <a href="payments.php">Add Payments</a>
        </div>

        <div class="widget large-widget">
            <h2>Recent Projects</h2>
            <div class="table-container">
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#totalClientsData').text('Loading...');
            $('#totalProjectsData').text('Loading...');
            $('#totalPaymentsData').text('Loading...');
            const tbody = $('.table-container table tbody');
            tbody.empty().append('<tr><td colspan="5">Loading...</td></tr>');

            $.ajax({
    url: 'dashboard.php?action=getDashboardData', // The same PHP file with action parameter
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        // Convert totalPayments to a number to avoid the toFixed error
        const totalPayments = parseFloat(response.totalPayments) || 0;
        
        // Now safely apply toFixed
        $('#totalClientsData').text(response.totalClients || 0);
        $('#totalProjectsData').text(response.totalProjects || 0);
        $('#totalPaymentsData').text('$' + totalPayments.toFixed(2));

        let rows = '';
        response.recentPayments.forEach(function (payment) {
            rows += "<tr>" +
                "<td>" + payment.projectName + "</td>" +
                "<td>" + payment.clientName + "</td>" +
                "<td>" + payment.amountPaid + "</td>" +
                "<td>" + payment.paymentDate + "</td>" +
                "<td>" + payment.paymentMethod + "</td>" +
                "</tr>";
        });
        tbody.html(rows);
    },
    error: function (error) {
        console.error('Error:', error);
        $('#totalClientsData').text('Error');
        $('#totalProjectsData').text('Error');
        $('#totalPaymentsData').text('Error');
        tbody.empty().append('<tr><td colspan="5">Error fetching data</td></tr>');
    }
});

        });
    </script>
</body>
</html>
