<?php
session_start();
include("db_connect.php");


$request_sent=false;
// CHECK LOGIN
if(!isset($_SESSION['patient_id'])){
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];
$patient_name = $_SESSION['patient_name'];


// FETCH BLOOD BANKS FOR DROPDOWN
$bank_query = "SELECT bank_id, bank_name FROM blood_banks";
$banks = mysqli_query($conn, $bank_query);

if(!$banks){
    die("Bank Query Failed: " . mysqli_error($conn));
}


// INSERT REQUEST
if(isset($_POST['request'])){

    $hospital = $_POST['hospital'];
    $bank_id = $_POST['bank_id'];
    $doctor = $_POST['doctor'];
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];

    $sql = "INSERT INTO requests
    (patient_id, bank_id, hospital_name, doctor_name, blood_group, units, request_date, status)
    VALUES
    ('$patient_id','$bank_id','$hospital','$doctor','$blood_group','$units', NOW(), 'Pending')";

    if(mysqli_query($conn,$sql)){
        //echo "<p style='color:green;'>Request Sent Successfully</p>";
        $request_sent=true;
    } else {
        echo "<p style='color:red;'>Error: ".mysqli_error($conn)."</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>

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
<a href="patient_profile.php">My Profile</a> 
<a href="patient_request_history.php">Request History</a> 
</div>

<div class="card">
<h2>Welcome <?php echo $patient_name; ?></h2>
</div>

<div class="card">
<h3>Request Blood</h3>

<form method="post">

Hospital Name:<br>
<input type="text" name="hospital" required><br><br>

Select Blood Bank:<br>
<select name="bank_id" required>
    <option value="">Select Bank</option>
    <?php while($row = mysqli_fetch_assoc($banks)) { ?>
        <option value="<?php echo $row['bank_id']; ?>">
            <?php echo $row['bank_name']; ?>
        </option>
    <?php } ?>
</select><br><br>

Doctor Name:<br>
<input type="text" name="doctor" required><br><br>

Blood Group Needed:<br>
<select name="blood_group" required>
    <option>A+</option>
    <option>A-</option>
    <option>B+</option>
    <option>B-</option>
    <option>O+</option>
    <option>O-</option>
    <option>AB+</option>
    <option>AB-</option>
</select><br><br>

Units Required:<br>
<input type="number" name="units" min="1" required><br><br>

<button type="submit" name="request">Send Request</button>

</form>
</div>

<!--for special effects-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if($request_sent): ?>
<script>
    Swal.fire({
        title: 'Request sent Successfully',
        icon: 'success',
        confirmButtonColor: 'green',
        confirmButtonText: 'OK'
    });
</script>
<?php endif; ?>
</body>
</html>