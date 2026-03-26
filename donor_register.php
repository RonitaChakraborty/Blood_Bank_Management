<?php
include 'db_connect.php';   // your DB connection
session_start();

$register_done=false;
/* ---------- REGISTER ---------- */
if(isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $blood_group = $_POST['blood_group'];
    $password = $_POST['password'];

    $sql = "INSERT INTO donors (name,email,contact,blood_group,password)
            VALUES ('$name','$email','$contact','$blood_group','$password')";

    if(mysqli_query($conn,$sql)) {
        /*echo "Registration Successful";*/$register_done=true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Registration</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url("Login background.jpg") no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        /* Register Box */
        .form-container {
            margin-left: 80px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .tagline {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #e53935;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #c62828;
        }

        .login-link {
            display: block;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            color: #e53935;
            font-weight: bold;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>

    <div class="form-container">
        <h2>Join as Donor</h2>
        <div class="tagline">Donate blood, save lives ❤️</div>

        <form method="POST">

            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Contact:</label>
            <input type="text" name="contact" pattern="[0-9]{10}" maxlength="10" required title="Enter 10 digits">

            <label>Blood Group:</label>
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

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="register">Register</button>

        </form>

        <a href="donor_login.php" class="login-link">
            Already have an account? Login
        </a>
    </div>

    <!--for special effects-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if($register_done): ?>
<script>
    Swal.fire({
        title: 'Registration Successfull',
        icon: 'success',
        confirmButtonColor: 'green',
        confirmButtonText: 'OK'
    });
</script>
<?php endif; ?>
</body>
</html>