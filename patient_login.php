<?php
session_start();
include("db_connect.php");

$login_error=false;

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM patients 
            WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        $_SESSION['patient_id'] = $row['patient_id'];
        $_SESSION['patient_name'] = $row['name'];

        header("Location: patient_dashboard.php");
        exit();
    } else {
       $login_error=true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Login</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('Login background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            margin-left: 80px;
            border-radius: 12px;
            width: 300px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #d10000;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
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
        .home{
            position:absolute;
            top:20px;
            left:20px;
            border:none;
            border-radius:4px;
            padding:5px;
            background:darkred;
            opacity:0.6;
            color:white;
           
        }
        .home:hover{
            opacity:1;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Welcome Patient</h2>

    <form method="post">
        Email:
        <input type="email" name="email" required>

        Password:
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <a href="patient_register.php">New User? Register Here</a>
</div>
<a class="home" href="index.php" >Home
</a>
</a>
</a>

<!--for special effects-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if($login_error): ?>
<script>
    Swal.fire({
        title: 'Login Failed',
        text: 'Invalid Email or Password. Please try again.',
        icon: 'error',
        confirmButtonColor: '#d10000',
        confirmButtonText: 'OK'
    });
</script>
<?php endif; ?>
</body>
</html>