<?php
session_start();
include("db_connect.php");

// LOGOUT
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// LOGIN CHECK
if(!isset($_SESSION['donor_id'])){
    header("Location: donor_login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];

// EDIT MODE
$editMode = isset($_GET['edit']);

// SAVE PROFILE
if(isset($_POST['save'])){
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];

    mysqli_query($conn,
        "UPDATE donors 
         SET name='$name', email='$email', contact='$contact' 
         WHERE donor_id='$donor_id'"
    );

    header("Location: donor_dashboard.php");
    exit();
}

// DONOR DETAILS
$donorQuery = mysqli_query($conn, "SELECT * FROM donors WHERE donor_id='$donor_id'");
$donorData  = mysqli_fetch_assoc($donorQuery);

// TOTAL DONATIONS
$countQuery = mysqli_query($conn,
    "SELECT COUNT(*) as total FROM donations WHERE donor_id='$donor_id'");
$countData = mysqli_fetch_assoc($countQuery);
$totalDonations = $countData['total'];

// TOTAL UNITS
$unitQuery = mysqli_query($conn,
    "SELECT SUM(units) as total_units FROM donations WHERE donor_id='$donor_id'");
$unitData = mysqli_fetch_assoc($unitQuery);
$totalUnits = $unitData['total_units'] ?? 0;

// LAST DONATION DATE
$lastQuery = mysqli_query($conn,
    "SELECT donation_date FROM donations 
     WHERE donor_id='$donor_id' 
     ORDER BY donation_date DESC LIMIT 1");
$lastData = mysqli_fetch_assoc($lastQuery);
$lastDate = $lastData['donation_date'] ?? "No Donation Yet";

// DONATION HISTORY WITH BANK NAME
$historyQuery = mysqli_query($conn,
"SELECT d.*, b.bank_name
 FROM donations d
 JOIN blood_banks b ON d.bank_id = b.bank_id
 WHERE d.donor_id='$donor_id'
 ORDER BY d.donation_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Donor Dashboard</title>
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

        h2,h3{
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

        .edit{
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .edit:hover {
            background: darkred;
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

         button {
            background: red;
            padding:10px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border:none;
        }

        button:hover {
            background: darkred;
        }


    </style>
</head>
<body>

<div class="overlay">

<div class="navbar">
<a href="index.php">Home</a>
</div>

<div class="card">
<h2>Welcome ! <?php echo $donorData['name']; ?></h2>
</div>

<div class="card">
<h3>Your Details</h3>

<?php if($editMode) { ?>
<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $donorData['name']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $donorData['email']; ?>"><br>
    Contact: <input type="text" name="contact" value="<?php echo $donorData['contact']; ?>"><br>
    Blood Group: <?php echo $donorData['blood_group']; ?><br><br>


    <button type="submit" name="save">Save</button>
    <button a href="donor_dashboard.php">Cancel</a></button>
</form>

<?php } else { ?>

<p>Name: <?php echo $donorData['name']; ?></p>
<p>Email: <?php echo $donorData['email']; ?></p>
<p>Contact: <?php echo $donorData['contact']; ?></p>
<p>Blood Group: <?php echo $donorData['blood_group']; ?></p>

<a class="edit" href="donor_dashboard.php?edit=true">Edit Profile</a>

<?php } ?>

<hr>

<div class="card">
<h3>Donation Summary</h3>
<p>Total Donations: <?php echo $totalDonations; ?></p>
<p>Total Units Donated: <?php echo $totalUnits; ?></p>
<p>Last Donation Date: <?php echo $lastDate; ?></p>
<hr>
</div>


<div class="card">
<h3>Donation History</h3>
<table border="1" cellpadding="8">
<tr>
<th>Date</th>
<th>Bank</th>
<th>Collection Place</th>
<th>Units</th>
<th>Blood Group</th>
</tr>

<?php while($row = mysqli_fetch_assoc($historyQuery)) { ?>
<tr>
<td><?php echo $row['donation_date']; ?></td>
<td><?php echo $row['bank_name']; ?></td>
<td><?php echo $row['collection_place']; ?></td>
<td><?php echo $row['units']; ?></td>
<td><?php echo $row['blood_group']; ?></td>
</tr>
<?php } ?>

</table>
</div>
<br>
<a class="logout" href="donor_dashboard.php?logout=true">Logout</a>

</body>
</html>