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
            <li><a href="home.html">Home</a></li>
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

<!-- header section ends -->
<?php
require_once('db_config.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user has exceeded the maximum login attempts
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
        // User has exceeded login attempts, lock the login for 10 minutes
        $lockTime = strtotime($_SESSION['last_login_attempt']) + 600; // 10 minutes in seconds
        if (time() < $lockTime) {
            $remainingTime = $lockTime - time();
            echo "Login is locked for $remainingTime seconds. Please try again later.";
            exit();
        } else {
            // Reset login attempts and unlock
            unset($_SESSION['login_attempts']);
            unset($_SESSION['last_login_attempt']);
        }
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Successful login
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            header("Location: pitch.html");
            exit();
        } else {
            // Failed login attempt
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 1;
            } else {
                $_SESSION['login_attempts']++;
            }
            $_SESSION['last_login_attempt'] = date('Y-m-d H:i:s'); // Store the timestamp of the last login attempt
            echo "Invalid password. Attempts: {$_SESSION['login_attempts']}/3";
        }
    } else {
        // Failed login attempt
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }
        $_SESSION['last_login_attempt'] = date('Y-m-d H:i:s'); // Store the timestamp of the last login attempt
        echo "User not found. Attempts: {$_SESSION['login_attempts']}/3";
    }
}
?>
<section class="login-form">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>user login</h3>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="email" name="email" placeholder="enter your email" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-lock"></span>
                <input type="password" name="password" placeholder="enter your password" required>
            </div>
            <input type="submit" value="sign in" class="btn">
            <div class="flex">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">remember me</label>
                <a href="#">forgot password?</a>
            </div>
            <a href="register.html" class="btn">create an account</a>
        </form>
    </section>

   


<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="home.html"> <i class="fas fa-angle-right"></i> home</a>
            <a href="products.html"> <i class="fas fa-angle-right"></i> products</a>
            <a href="about.html"> <i class="fas fa-angle-right"></i> about</a>
            <a href="blogs.html"> <i class="fas fa-angle-right"></i> blogs</a>
            <a href="contact.html"> <i class="fas fa-angle-right"></i> contact</a>
            <a href="login.html"> <i class="fas fa-angle-right"></i> login</a>
            <a href="register.html"> <i class="fas fa-angle-right"></i> register</a>
            <a href="cart.html"> <i class="fas fa-angle-right"></i> cart</a>
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