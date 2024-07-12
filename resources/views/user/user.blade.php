<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mathematics Challenge</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            padding: 20px;
        }

         .logo img{
        
         }


        .header {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #5f9ea0, #4682b4);
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 3em;
            font-weight: bold;
        }
        .header p {
            font-size: 1.2em;
            margin: 10px 0 0;
        }
        .content {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .register-button {
            width: 200px;
            padding: 15px;
            background-color: #4682b4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .register-button:hover {
            background-color: #5f9ea0;
        }
        
        
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .footer div {
            flex: 1 1 30%;
            padding: 10px;
            box-sizing: border-box;
            min-width: 250px;
        }
        .footer h5 {
            margin-top: 0;
        }
        .footer-icons {
            margin: 10px 0;
        }
        .footer-icons a {
    text-decoration: none;
    color: white; /* Change icon color to white */
    font-size: 2rem; /* Increase the size of the icons */
    margin: 0 10px; /* Add some spacing between the icons */
}

.footer-icons a:hover {
    color: #f0f0f0; /* Slightly change color on hover for better UX */
}
            
        }
        .footer-bottom {
            background-color: #222;
            color: #ccc;
            padding: 10px 0;
            font-size: 0.9em;
        }
        .footer-bottom p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="#home">Home</a>
        
        
        <a href="{{ route('login') }}">Log In</a>
    </div>

    <div class="header">
        <div class="logo"><img src=alt=""></div>
        <h1>Welcome to the Mathematics Challenge</h1>
        <p>Sharpen your skills with exciting challenges and competitions</p>
    </div>

    <div class="container">
        <div class="content" id="home">
            <h2>MTC CHALLENGE</h2>
            <p>Welcome to the Mathematics Challenge. This is a platform designed to test and improve your mathematical skills through various challenges and competitions.</p>
            <a href="register.html" class="register-button">Register Now</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <h5>About Us</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div>
            <h5>Contact</h5>
            <p>1234 Street Name<br>City, State, 12345</p>
        </div>
        <div>
            <h5>Follow Us</h5>
            <div class="footer-icons">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="#"><i class="fa-brands fa-viber"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
          <a href="#"><i class="fa-brands fa-google-plus"></i></a>
            </div>
        </div>
    </footer>

    <div class="footer-bottom">
        <p>&copy; 2024 Mathematics Challenge. All Rights Reserved.</p>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
