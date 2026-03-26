<?php
session_start();
include("db_connect.php");

/* ---------- ADMIN SESSION CHECK ---------- */
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
$bank_id = $_SESSION['bank_id'];

if(isset($_POST['action']) && isset($_POST['request_id'])){
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // IF ACTION IS COMPLETED → SUBTRACT STOCK
    if($action == "Completed"){

        // 1. Get blood group & units from request
        $getReq = mysqli_query($conn, "SELECT blood_group, units FROM requests WHERE request_id='$request_id'");
        $reqData = mysqli_fetch_assoc($getReq);

        $blood_group = $reqData['blood_group'];
        $units = $reqData['units'];

        // 2. Subtract from blood_stock table
        mysqli_query($conn, "UPDATE blood_stock 
                             SET units = units - $units 
                             WHERE blood_group='$blood_group' AND units >= $units");
    }

    // 3. Update request status
    $update = "UPDATE requests SET status='$action' WHERE request_id='$request_id' AND bank_id='$bank_id' ";
    mysqli_query($conn, $update);
}
/* ---------- FETCH REQUESTS ---------- */
$sql = "
SELECT r.*, 
       p.name, p.email, p.contact, p.age, p.gender
FROM requests r
JOIN patients p ON r.patient_id = p.patient_id
WHERE r.bank_id='$bank_id'
ORDER BY r.request_date DESC
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Blood Requests</title>
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
            padding: 5px;
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
<h2>Patient Blood Requests</h2>
</div>

<div class="card">
<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Contact</th>
<th>Age</th>
<th>Gender</th>
<th>Hospital</th>
<th>Doctor</th>
<th>Blood Group</th>
<th>Units</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $row['request_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['contact']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['hospital_name']; ?></td>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['request_date']; ?></td>

<td>
<?php
// ---------- ACTION LOGIC ----------
// --- NEW STOCK CHECK LOGIC ---
$current_bg = $row['blood_group'];
$requested_units = $row['units'];

// Fetch available stock for this specific group
$stockQuery = mysqli_query($conn, "SELECT units FROM blood_stock WHERE blood_group = '$current_bg' AND bank_id = '$bank_id'");
$stockData = mysqli_fetch_assoc($stockQuery);
$available_units = $stockData['units'] ?? 0;
if($row['status'] == 'Pending'){
    ?>
    <form method="POST">
        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
        
        <?php if($available_units >= $requested_units): ?>
            <button type="submit" name="action" value="Accepted">Accept</button>
        <?php else: ?>
            <span style="color:red; font-size:12px;">Out of Stock</span>
        <?php endif; ?>
        
        <button type="submit" name="action" value="Rejected">Reject</button>
    </form>
    <?php
}
elseif($row['status'] == 'Accepted'){
    ?>
    <form method="POST">
        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
        
        <?php if($available_units >= $requested_units): ?>
            <button type="submit" name="action" value="Completed">Complete</button>
        <?php else: ?>
            <span style="color:red; font-size:12px;">Stock depleted since acceptance</span>
        <?php endif; ?>
    </form>
    <?php
}
else{
    echo "Action Done";
}
}
?>

</table>
</div>

</body>
</html>