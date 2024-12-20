<?php
// Include database connection
include 'db_connection.php';

// Fetch clients for the dropdown
$clients = [];
$conn = OpenCon();
$sql = "SELECT clientName FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row['clientName'];
    }
}
CloseCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            animation: fadeIn 1.5s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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
            font-family: 'Poppins', sans-serif;
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
            opacity: 0;
            animation: popUp 1.5s ease forwards;
        }
        @keyframes popUp {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        .box h1 {
            color: #fff;
            margin-bottom: 20px;
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
        .form-group input:hover, .form-group select:hover {
            transform: scale(1.05);
        }
        .form-group input::placeholder {
            color: black;
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
        .register p a:hover::after {
            width: 100%;
        }
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
        <h1>Add New Project</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <form action="projects.php" method="POST">
            <div class="form-group">
                <label for="projectName">Project Name</label>
                <input type="text" id="projectName" name="projectName" placeholder="Enter Project Name" required>
            </div>
            <div class="form-group">
                <label for="client">Client Name</label>
                <select id="client" name="client" required>
                    <option value="" disabled selected>Select Client</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client; ?>"><?php echo $client; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" id="deadline" name="deadline" placeholder="Select Deadline" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="Enter Project Description" required>
            </div>
            <button class="btn" type="submit">Add Project</button>
        </form>
        <div class="register">
            <p>Want to view all Projects? <a href="viewprojects.php">View Projects</a></p>
        </div>
    </div>
    <?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectName = $_POST['projectName'];
    $client = $_POST['client'];
    $deadline = $_POST['deadline'];
    $description = $_POST['description'];

    $conn = OpenCon();
    $sql = "INSERT INTO projects (projectName, clientName, deadline, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $projectName, $client, $deadline, $description);

    if ($stmt->execute()) {
        $success = "Project added successfully!";
    } else {
        $error = "Error adding Project";
    }

    $stmt->close();
   
}
?>
</body>
</html>