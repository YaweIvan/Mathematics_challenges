<!DOCTYPE html>
<html lang="en">
<head>
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
        .math-image {
            max-width: 100%;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .footer p {
            margin: 10px 0;
            font-size: 1em;
        }
        .footer-icons {
            margin: 10px 0;
        }
        .footer-icons a {
            margin: 0 10px;
            transition: transform 0.3s;
        }
        .footer-icons img {
            width: 24px;
            height: 24px;
        }
        .footer-icons a:hover {
            transform: scale(1.2);
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
        <a href="#about-us">About Us</a>
        <a href="#contact-us">Contact Us</a>
        <a href="{{ route('login') }}">Log In</a>
    </div>

    <div class="header">
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
    <footer class="footer bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p>1234 Street Name<br>City, State, 12345</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white"><i class="icon ion-logo-facebook"></i></a>
                    <a href="#" class="text-white"><i class="icon ion-logo-twitter"></i></a>
                    <a href="#" class="text-white"><i class="icon ion-logo-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
