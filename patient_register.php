<?php
include("db_connect.php");
$register_done=false;
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $password = $_POST['password'];

    // check duplicate email
    $check = mysqli_query($conn,"SELECT * FROM patients WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "Email already exists!";
    } else {

        $sql = "INSERT INTO patients
        (name,email,contact,age,gender,blood_group,password)
        VALUES
        ('$name','$email','$contact','$age','$gender','$blood_group','$password')";

        if(mysqli_query($conn,$sql)){
           // echo "Registered Successfully. <a href='patient_login.php'>Login Now</a>";
           $register_done=true;
        } else {
            echo "Error: ".mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Register</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('Login background.jpg') no-repeat center center/cover fixed;
            min-height: 100vh;
            height:auto;
            padding:20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .form-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px 35px;
            margin-left: 50px;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #d10000;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .gender {
            margin: 10px 0;
        }

        .gender input {
            width: auto;
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #d10000;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #a00000;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #d10000;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2>Welcome Patient</h2>

    <form method="post">

        Name:
        <input type="text" name="name" required>

        Email:
        <input type="email" name="email" required>

        Contact:
        <input type="text" name="contact" pattern="[0-9]{10}" maxlength="10" required title="Enter 10 digits">

        Age:
        <input type="number" name="age" required>

        Gender:
        <div class="gender">
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female"> Female
            <input type="radio" name="gender" value="Other"> Other
        </div>

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

        Password:
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <a href="patient_login.php">Already have account? Login</a>
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
</body>
</html>