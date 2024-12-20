<?php
// Start session and handle database connection
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "freelance"; // Replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch projects from the database
$projects = [];
$sql = "SELECT projectName, clientName, deadline, description FROM projects";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
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
    <title>View Projects</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Reset and Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Lora", serif;
        }

        body {
            background: url(signup.jpg);
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
            var projects = <?php echo json_encode($projects); ?>;
            var rows = "";
            
            if (projects.length > 0) {
                projects.forEach(function (project) {
                    rows += "<tr>" +
                        "<td>" + project.projectName + "</td>" +
                        "<td>" + project.clientName + "</td>" +
                        "<td>" + project.deadline + "</td>" +
                        "<td>" + project.description + "</td>" +
                        "</tr>";
                });
            } else {
                rows = '<tr><td colspan="4" class="no-data">No projects found</td></tr>';
            }
            
            $("#projectTable tbody").html(rows);
        });
    </script>
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

    <div class="container">
        <h1>Project List</h1>
        <table id="projectTable">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Client Name</th>
                    <th>Deadline</th>
                    <th>Description</th>
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
