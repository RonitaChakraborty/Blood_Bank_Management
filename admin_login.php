<?php
session_start();
include 'db_connect.php';

$login_error=false;

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['bank_id'] = $row['bank_id'];
        $_SESSION['admin_name'] = $row['name']; 

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $login_error=true;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

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

        /* Login Box */
        .login-container {
            margin-left: 80px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            width: 300px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #d10000;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input {
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
            text-decoration:none;
           
        }
        .home:hover{
            opacity:1;
            text-decoration:none;
        }
    </style>

</head>

<body>

    <div class="login-container">
        <h2>Welcome Admin!</h2>

        <form method="POST">

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>

        </form>
    </div>
    <a class="home" href="index.php" >Home

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