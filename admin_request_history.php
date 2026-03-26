<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
$bank_id = $_SESSION['bank_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Request History</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('background 1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        /* OVERLAY for readability */
        .overlay {
            background: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            padding: 20px;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #ff4d4d;
        }

        /* CARD STYLE */
        .card {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        h2, h3 {
            margin-top: 0;
        }

        /* TABLE STYLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background: #ff4d4d;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        table tr:hover {
            background: #f5f5f5;
        }

    </style>
</head>
<body>
<div class="overlay">

<!-- NAVBAR -->
<div class="navbar">
<a href="index.php">Home</a> 
<a href="admin_dashboard.php">Dashboard</a> 
<a href="admin_donor_view.php">Donors</a> 
<a href="admin_request_table.php">Requests</a> 
<a href="admin_request_history.php">Request History</a> 
<a href="admin_stock_check.php">Stock</a> 
</div>

<div class="card">
<h2>Request History</h2>
</div>

<div class="card">
<table border="1" cellpadding="8">
<tr>
    <th>Request ID</th>
    <th>Patient Name</th>
    <th>Contact</th>
    <th>Blood Group</th>
    <th>Hospital</th>
    <th>Doctor Name</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php
$sql = "SELECT r.*, p.name, p.contact 
        FROM requests r
        JOIN patients p ON r.patient_id = p.patient_id
        WHERE r.bank_id='$bank_id'
        AND r.status != 'Pending'
        ORDER BY r.request_date DESC";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php echo $row['request_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>
    <td><?php echo $row['hospital_name']; ?></td>
    <td><?php echo $row['doctor_name']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['request_date']; ?></td>
</tr>
<?php
}
?>

</table>
</div>
</body>
</html>