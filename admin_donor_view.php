<?php
session_start();
include("db_connect.php");

// CHECK LOGIN
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$bank_id = $_SESSION['bank_id'];

// UPDATE DONATION
if(isset($_POST['update'])){
    $donation_id = $_POST['donation_id'];
    $units = $_POST['units'];
    $place = $_POST['collection_place'];
    $date  = $_POST['donation_date'];

    mysqli_query($conn,
    "UPDATE donations 
     SET units='$units',
         collection_place='$place',
         donation_date='$date'
     WHERE donation_id='$donation_id'
     AND bank_id='$bank_id'");
}

// FETCH DONATIONS FOR THIS BANK
$query = mysqli_query($conn,
"SELECT d.*, dn.name, dn.email, dn.contact
 FROM donations d
 JOIN donors dn ON d.donor_id = dn.donor_id
 WHERE d.bank_id='$bank_id'
 ORDER BY d.donation_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Donations</title>

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

    <!-- WELCOME -->
<div class="card">
  <h2>Donations to Your Bank</h2>
</div>

<div class="card">

<table border="1" cellpadding="8">
<tr>
<th>Donor Name</th>
<th>Email</th>
<th>Contact</th>
<th>Blood Group</th>
<th>Units</th>
<th>Collection Place</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>
<tr>
<form method="POST">
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['contact']; ?></td>
<td><?php echo $row['blood_group']; ?></td>

<td>
<input type="number" name="units" value="<?php echo $row['units']; ?>">
</td>

<td>
<input type="text" name="collection_place"
value="<?php echo $row['collection_place']; ?>">
</td>

<td>
<input type="date" name="donation_date"
value="<?php echo $row['donation_date']; ?>">
</td>

<td>
<input type="hidden" name="donation_id"
value="<?php echo $row['donation_id']; ?>">
<button type="submit" name="update">Save</button>
</td>
</form>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>