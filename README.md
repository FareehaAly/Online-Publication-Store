
Bookstore Web Application

 A simple PHP-based bookstore application with user login and registration functionality. Users can register, log in, and view available books. Admins can be added separately.
 
🔗 [Live on GitHub](https://github.com/FareehaAly/Online-Publication-Store)

   Features

-  User Registration & Login using PHP sessions
-  Display available books from MySQL database
-  Option to return to Home Page after login
-  Styled using basic CSS and layout

    Getting Started

  1. Clone the Repository

```bash
git clone https://github.com/FareehaAly/Online-Publication-Store.git
cd Online-Publication-Store

2. Setup Instructions

Move the project to htdocs folder in XAMPP
Start Apache and MySQL from XAMPP control panel

3. Import the Database

Open phpMyAdmin
Create a database: bookstore
Import your bookstore.sql file (manually export it from your working version if not included)

4.  Make sure you have db.php file

5. Run the Project:
Visit in browser:   http://localhost/Online-Publication-Store/index.php

Notes:
You can also add admin login by creating a separate admins table.
Passwords can be secured using password_hash() and password_verify() for better security.



Here how files are structured:

Online-Publication-Store/
├── db.php              # Database connection
├── index.php           # Main login/register and book view
├── logout.php          # Ends the session
├── home.php            # Optional landing page
└── README.md           # You're here!


This project is for learning purposes only.

Let me know if you want a `.sql` export file created, or if you'd like a separate **admin panel README section** added!










