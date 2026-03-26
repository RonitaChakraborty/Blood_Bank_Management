<?php
session_start();
include("db_connect.php");

// LOGOUT CHECK
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$bank_id = $_SESSION['bank_id'];

// BANK DETAILS
$bank_sql = "SELECT * FROM blood_banks WHERE bank_id='$bank_id'";
$bank_res = mysqli_query($conn, $bank_sql);
$bank = mysqli_fetch_assoc($bank_res);

// BLOOD STOCK
$stock_sql = "SELECT * FROM blood_stock WHERE bank_id='$bank_id'";
$stock_res = mysqli_query($conn, $stock_sql);

// STATS  ✅ ADD HERE

// TOTAL PATIENTS
$total_sql = "SELECT COUNT(*) as total FROM requests WHERE bank_id='$bank_id'";
$total_res = mysqli_query($conn, $total_sql);
$total_patients = mysqli_fetch_assoc($total_res)['total'];

// PENDING
$pending_sql = "SELECT COUNT(*) as pending FROM requests WHERE status='Pending' AND bank_id='$bank_id'";
$pending_res = mysqli_query($conn, $pending_sql);
$pending = mysqli_fetch_assoc($pending_res)['pending'];

// ACCEPTED
$accepted_sql = "SELECT COUNT(*) as accepted FROM requests WHERE status='Accepted' AND bank_id='$bank_id'";
$accepted_res = mysqli_query($conn, $accepted_sql);
$accepted = mysqli_fetch_assoc($accepted_res)['accepted'];

// REJECTED
$rejected_sql = "SELECT COUNT(*) as rejected FROM requests WHERE status='Rejected' AND bank_id='$bank_id'";
$rejected_res = mysqli_query($conn, $rejected_sql);
$rejected = mysqli_fetch_assoc($rejected_res)['rejected'];

// COMPLETED
$completed_sql = "SELECT COUNT(*) as completed FROM requests WHERE status='Completed' AND bank_id='$bank_id'";
$completed_res = mysqli_query($conn, $completed_sql);
$completed = mysqli_fetch_assoc($completed_res)['completed'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

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

        /* LOGOUT BUTTON */
        .logout {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout:hover {
            background: darkred;
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

    <!-- WELCOME -->
    <div class="card">
        <h2>Welcome <?php echo $_SESSION['admin_name']; ?></h2>
    </div>

    <!-- BANK DETAILS -->
    <div class="card">
        <h3>Bank Details</h3>
        <p><b>Name:</b> <?php echo $bank['bank_name']; ?></p>
        <p><b>Address:</b> <?php echo $bank['address']; ?></p>
        <p><b>Contact:</b> <?php echo $bank['contact']; ?></p>
    </div>

    <!-- BLOOD STOCK -->
    <div class="card">
        <h3>Blood Stock</h3>
        <table>
            <tr>
                <th>Blood Group</th>
                <th>Units</th>
            </tr>
             <?php while($row = mysqli_fetch_assoc($stock_res)) { ?>
            <tr>
                <td><?php echo $row['blood_group']; ?></td>
                <td><?php echo $row['units']; ?></td>
            </tr>
             <?php } ?>
        </table>
    </div>

    <!-- TOTAL STATS -->
    <div class="card">
        <h3>Total Statistics</h3>
        <table>
           
            <tr>
                <th>Total Patients</th>
                <th>Pending</th>
                <th>Accepted</th>
                <th>Rejected</th>
                <th>Completed</th>
            </tr>
            <tr>
                <td><?php echo $total_patients; ?></td>
                <td><?php echo $pending; ?></td>
                <td><?php echo $accepted; ?></td>
                <td><?php echo $rejected; ?></td>
                <td><?php echo $completed; ?></td>
            </tr>
        </table>
    </div>

    <!-- LOGOUT -->
    <a class="logout" href="admin_dashboard.php?logout=true">Logout</a>

</div>

</body>
</html>