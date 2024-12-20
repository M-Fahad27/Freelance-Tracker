<?php
include 'db_connection.php';

$totalClients = 0;
$totalProjects = 0;
$totalPayments = 0.0;
$recentPayments = [];

$conn = OpenCon();

// Fetch total clients
$sqlClients = "SELECT COUNT(*) AS totalClients FROM clients";
$resultClients = $conn->query($sqlClients);
if ($resultClients->num_rows > 0) {
    $totalClients = $resultClients->fetch_assoc()['totalClients'];
}

// Fetch total projects
$sqlProjects = "SELECT COUNT(*) AS totalProjects FROM projects";
$resultProjects = $conn->query($sqlProjects);
if ($resultProjects->num_rows > 0) {
    $totalProjects = $resultProjects->fetch_assoc()['totalProjects'];
}

// Fetch total payments
$sqlPayments = "SELECT SUM(amountPaid) AS totalPayments FROM payments";
$resultPayments = $conn->query($sqlPayments);
if ($resultPayments->num_rows > 0) {
    $totalPayments = $resultPayments->fetch_assoc()['totalPayments'];
}

// Fetch recent payments
$sqlRecentPayments = "SELECT projectName, clientName, amountPaid, paymentMethod, paymentDate FROM payments ORDER BY paymentDate DESC LIMIT 10";
$resultRecentPayments = $conn->query($sqlRecentPayments);
if ($resultRecentPayments->num_rows > 0) {
    while ($row = $resultRecentPayments->fetch_assoc()) {
        $recentPayments[] = $row;
    }
}

CloseCon($conn);

$response = [
    'totalClients' => $totalClients,
    'totalProjects' => $totalProjects,
    'totalPayments' => $totalPayments,
    'recentPayments' => $recentPayments
];

header('Content-Type: application/json');
echo json_encode($response);
?>