<!DOCTYPE html>
<html>
<head>
    <title>HEMOhub - Saves lives</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Montserrat:wght@500;600&family=Oswald:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            /* Background Image */
            background: url('home background.avif') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 60px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            box-sizing: border-box; /* Ensures padding doesn't affect width */
            z-index: 1000; /* Keeps it above other content */
         }

       .logo {
          font-size: 22px;
          font-weight: bold;
          color: white;
          display: flex;
          align-items: center;
          gap: 8px;
        }

       .plus {
           background: red;
           color: white;
           font-weight: bold;
           width: 22px;
           height: 22px;
           display: flex;
           align-items: center;
           justify-content: center;
           border-radius: 4px; /* slight rounded */
        }

        .nav-links a {
            color: white;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
            position: relative;
        }

        /* Hover effect */
        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background: red;
            left: 0;
            bottom: -5px;
            transition: 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }
       
        .notice {
           padding: 12px 18px;
           font-size: 15px;
           width: fit-content;    /* Shrinks the box to fit the text perfectly */
           max-width: 360px;
    
        /* Centering Logic */
           position: absolute;
           bottom: 30px;
           left: 10%;   

         /* Glassmorphism Styles */
            background: rgba(0, 0, 0, 0.6); 
            backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            z-index: 10;
            line-height: 1.4;
         }

        .notice h3 {
           font-family: 'Oswald', sans-serif;
           letter-spacing: 0.5px;
           margin: 0 0 8px 0;
           color: #ff4d4d;
           font-size: 18px;
           text-transform: uppercase;
           text-align: center;    
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
       <div class="logo">
    <span class="plus">+</span> HEMOhub
</div>

        <div class="nav-links">
            <a href="admin_login.php">Admin</a>
            <a href="donor_login.php">Donor</a>
            <a href="patient_login.php">Patient</a>
        </div>
    </div>

        <div class="notice">
            <h3>Upcoming Blood Donation Camp </h3>
            📍 Location: KIIT University, Bhubaneswar <br>
            📅 Date: 5th April 2026 <br>
            ⏰ Time: 9:00 AM – 4:00 PM
        </div>
    </div>
</body>
</html>