
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GWSC</title>
   
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- custom js file link  -->
    <script src="js/script.js" defer></script>
    <style>
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- header section starts  -->

<header class="header">

    <a href="home.html" class="logo"> GWSC </a>

    <nav class="navbar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="products.html">Information</a></li>
            <li><a href="#">Pitch Types</a>
                
                    <li><a href="review.html">Reviews</a></li>
                    <li><a href="features.html">Features</a></li>
                
            </li>
            <li><a href="contact.html">contact</a></li>
            <li><a href="local.html">Local Attractions</a>
                <ul>
                    <li><a href="login.php">login</a></li>
                    <li><a href="register.php">register</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="search-btn" class="fas fa-search"></div>
        <a href="cart.html" class="fas fa-shopping-cart"></a>
    </div>

    <form action="" class="search-form">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>

</header>

<?php
require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email is already registered
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Email is not registered, insert the new user
        $insert_sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "Registration successful!";
            // You can also redirect the user to a login page or any other page after successful registration
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email is already registered.";
    }
}
?>

<section class="register-form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h3>Register Now</h3>
        <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" name="first_name" placeholder="First Name" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" name="last_name" placeholder="Last Name" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-lock"></span>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-lock"></span>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <input type="submit" value="Sign up" class="btn">
        <a href="login.html" class="btn">Already have an account</a>
    </form>
</section>


<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="home.html"> <i class="fas fa-angle-right"></i> home</a>
            <a href="about.html"> <i class="fas fa-angle-right"></i> about</a>
            <a href="blogs.html"> <i class="fas fa-angle-right"></i> blogs</a>
            <a href="contact.html"> <i class="fas fa-angle-right"></i> contact</a>
            <a href="login.html"> <i class="fas fa-angle-right"></i> login</a>
            <a href="register.html"> <i class="fas fa-angle-right"></i> register</a>
                </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#"> <i class="fas fa-angle-right"></i> my account </a>
            <a href="#"> <i class="fas fa-angle-right"></i> my order </a>
            <a href="#"> <i class="fas fa-angle-right"></i> my wishlist </a>
            <a href="#"> <i class="fas fa-angle-right"></i> terms of use </a>
            <a href="#"> <i class="fas fa-angle-right"></i> privacy policy </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-github"></i> github </a>
        </div>

        <div class="box">
            <h3>newsletter</h3>
            <p>subscribe for latest updates</p>
            <form action="">
                <input type="email" placeholder="enter your emal">
                <input type="submit" value="subscribe" class="btn">
            </form>
        </div>

    </div>

    
</section>

<!-- footer section ends -->

</body>

</html>
