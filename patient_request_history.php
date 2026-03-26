<?php
session_start();
include("db_connect.php");

// CHECK LOGIN
if(!isset($_SESSION['patient_id'])){
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// FETCH REQUESTS OF THIS PATIENT
$sql = "SELECT r.*, b.bank_name 
        FROM requests r
        JOIN blood_banks b ON r.bank_id = b.bank_id
        WHERE r.patient_id = '$patient_id'
        ORDER BY r.request_date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Request History</title>
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

<div class="navbar">
<a href="patient_dashboard.php">Dashboard</a>
</div>

<div class="card">
<h2>My Blood Request History</h2>
<table border="1" cellpadding="10">
<tr>
<th>Date</th>
<th>Blood Bank</th>
<th>Hospital</th>
<th>Doctor</th>
<th>Blood Group</th>
<th>Units</th>
<th>Status</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['request_date']; ?></td>
<td><?php echo $row['bank_name']; ?></td>
<td><?php echo $row['hospital_name']; ?></td>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php
    }
}else{
    echo "<tr><td colspan='7'>No Requests Found</td></tr>";
}
?>

</table>
</div>
</body>
</html>