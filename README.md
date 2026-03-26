My final year BCA project.

Project Overview

HEMOhub is a web-based Blood Bank Management System developed to efficiently manage blood donation, blood requests, and stock levels across different blood banks.

The system provides separate modules for Admin, Patient, and Donor, ensuring smooth coordination and data handling.

---

Features

Admin Module

- Admin login authentication
- Manage blood requests (Accept / Reject / Complete)
- View request history
- Manage blood stock (add/update units)
- View donor details

Patient Module

- Patient registration & login
- Request blood
- View request status & history
- Edit profile

Donor Module

- Donor registration & login
- View donation history
- Edit profile

---

Technologies Used

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- Server: XAMPP

---

Database Setup

1. Open phpMyAdmin
2. Create a new database (e.g., "blood_bank")
3. Import the provided SQL file:
   blood_bank.sql
4. Update database connection in:
   db_connect.php

---

 How to Run the Project

1. Install XAMPP
2. Copy the project folder into:
   C:\xampp\htdocs\
3. Start Apache and MySQL from XAMPP
4. Open browser and go to:
   http://localhost/Blood_Bank_System/
