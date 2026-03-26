<?php
session_start();
include("db_connect.php");

/* ---------- ADMIN SESSION CHECK ---------- */
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

/* ---------- ADD / UPDATE STOCK ---------- */
if(isset($_POST['blood_group']) && isset($_POST['units'])){
    $blood = $_POST['blood_group'];
    $units = $_POST['units'];

    
    $bank_id = $_SESSION['bank_id'];

    // check if blood group exists for this bank
     $check = mysqli_query($conn,
        "SELECT * FROM blood_stock 
         WHERE blood_group='$blood' AND bank_id='$bank_id'"
    );

    if(mysqli_num_rows($check) > 0){
        // update existing units
        mysqli_query($conn,
        "UPDATE blood_stock 
         SET units = units + $units 
         WHERE blood_group='$blood' AND bank_id='$bank_id'"
        );
    } else {
        // insert new row
        mysqli_query($conn,
        "INSERT INTO blood_stock(bank_id, blood_group, units) 
         VALUES('$bank_id','$blood','$units')"
        );
    }
}


/* ---------- FETCH STOCK ---------- */
$bank_id = $_SESSION['bank_id'];
// same bank
$stock_result = mysqli_query($conn,
    "SELECT * FROM blood_stock 
     WHERE bank_id='$bank_id' 
     ORDER BY blood_group ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Blood Stock</title>
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
<h2>Blood Stock Management</h2>
</div>

<div class="card">
<!-- ADD STOCK FORM -->
<form method="POST">
Blood Group:
<select name="blood_group" required>
<option value="">Select</option>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>O+</option>
<option>O-</option>
<option>AB+</option>
<option>AB-</option>
</select>

Units:
<input type="number" name="units" required>

<button type="submit">Add Units</button>
</form>

<hr>

<h3>Available Stock</h3>

<table border="1" cellpadding="8">
<tr>
<th>Blood Group</th>
<th>Units Available</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($stock_result)){
?>
<tr>
<td><?php echo $row['blood_group']; ?></td>
<td><?php echo $row['units']; ?></td>
</tr>
<?php
}
?>

</table>
</div>
</body>
</html>