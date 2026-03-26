<?php
session_start();
include("db_connect.php");

// not logged in
if(!isset($_SESSION['patient_id'])){
    header("Location: patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// LOGOUT
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}

// EDIT MODE CHECK
$edit = isset($_GET['edit']);

// FETCH DATA
$sql = "SELECT * FROM patients WHERE patient_id='$patient_id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

// UPDATE
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];

    $update = "UPDATE patients SET
        name='$name',
        contact='$contact',
        age='$age',
        gender='$gender',
        blood_group='$blood_group'
        WHERE patient_id='$patient_id'";

    mysqli_query($conn, $update);

    header("Location: patient_profile.php");
    exit();
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
    

        .edit {
            background: red;
            padding:10px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border:none;
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

    </style>
</head>
<body>

<div class="overlay">
<!-- NAVBAR -->
<div class="navbar">

    <a href="patient_dashboard.php">Dashboard</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
   
</div>
<div>

<div class="card">
<h2>My Profile</h2>

<?php if(!$edit){ ?>

    <p><b>Name:</b> <?php echo $data['name']; ?></p>
    <p><b>Email:</b> <?php echo $data['email']; ?></p>
    <p><b>Contact:</b> <?php echo $data['contact']; ?></p>
    <p><b>Age:</b> <?php echo $data['age']; ?></p>
    <p><b>Gender:</b> <?php echo $data['gender']; ?></p>
    <p><b>Blood Group:</b> <?php echo $data['blood_group']; ?></p>

    <a class="edit" href="patient_profile.php?edit=true">Edit Profile</a>
    
<?php } else { ?>

<form method="post">
    Name:<br>
    <input type="text" name="name" value="<?php echo $data['name']; ?>"><br><br>

    Contact:<br>
    <input type="text" name="contact" value="<?php echo $data['contact']; ?>"><br><br>

    Age:<br>
    <input type="number" name="age" value="<?php echo $data['age']; ?>"><br><br>

    Gender:<br>
    <select name="gender">
        <option <?php if($data['gender']=="Male") echo "selected"; ?>>Male</option>
        <option <?php if($data['gender']=="Female") echo "selected"; ?>>Female</option>
        <option <?php if($data['gender']=="Other") echo "selected"; ?>>Other</option>
    </select><br><br>

    Blood Group:<br>
    <select name="blood_group">
        <option <?php if($data['blood_group']=="A+") echo "selected"; ?>>A+</option>
        <option <?php if($data['blood_group']=="A-") echo "selected"; ?>>A-</option>
        <option <?php if($data['blood_group']=="B+") echo "selected"; ?>>B+</option>
        <option <?php if($data['blood_group']=="B-") echo "selected"; ?>>B-</option>
        <option <?php if($data['blood_group']=="O+") echo "selected"; ?>>O+</option>
        <option <?php if($data['blood_group']=="O-") echo "selected"; ?>>O-</option>
        <option <?php if($data['blood_group']=="AB+") echo "selected"; ?>>AB+</option>
        <option <?php if($data['blood_group']=="AB-") echo "selected"; ?>>AB-</option>
    </select><br><br>

    <button type="submit" name="save">Save</button>
    <button a href="patient_profile.php">Cancel</a>
</form>

<?php } ?>
</div>

<a class="logout" href="patient_profile.php?logout=true">Logout</a>

</body>
</html>