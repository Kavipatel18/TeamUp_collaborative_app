<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TeamUp Home Page</title>
    <link rel = "website icon" type="png" href="web-logo2.png">
    <link rel="stylesheet" href="style.css" />
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
    <?php
    include 'header.html';
    ?>
    
    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        
        <div class="form login_form">
          <form action="authenticate.php" method="post">
            <h2>Login</h2>

            <div class="input_box">
              <input type="email"  name ="email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" name = "password" placeholder="Enter your password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>

            <button class="button">Login Now</button>

            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
          </form>
        </div>
        </form>
        <!-- Signup From -->
        <form action="insert.php" method="post">
        <div class="form signup_form">
          <form action="#">
            <h2>Signup</h2>

            <div class="input_box">
              <input type="email" name = "email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" name ="password" placeholder="Create password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" name = "repassword" placeholder="Confirm password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <button class="button">Signup Now</button>

            <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          </form>
        </div>
      </div>
      <section class="hero" >
        <div class="container" style="color: black;">
            <h2>Welcome to TeamUp</h2>
            <p>Your platform for collaboration and teamwork.</p>
            <button class="button" style ="background-color:transparent;color:black;"id="form-open">Get Started</button>
            
        </div>
    </section>
  
    <section id="services" class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="service-item">
                <h3>Project Management</h3>
                <p>Efficiently manage your projects with our powerful tools.</p>
            </div>
            <div class="service-item">
                <h3>Team Collaboration</h3>
                <p>Work together seamlessly with your team no matter where you are.</p>
            </div>
            <div class="service-item">
                <h3>File Sharing</h3>
                <p>Share files securely and easily with your team members.</p>
            </div>
        </div>
    </section>
  
    <section id="pricing" class="pricing">
        <div class="container">
            <h2>Pricing Plans</h2>
            <div class="pricing-plans">
                <div class="plan">
                    <h3>Free</h3>
                    <p>Basic features for small teams</p>
                    <p>Price: $0/month</p>
                </div>
                <div class="plan">
                    <h3>Pro</h3>
                    <p>Advanced features for growing teams</p>
                    <p>Price: $10/month</p>
                </div>
                <div class="plan">
                    <h3>Enterprise</h3>
                    <p>Customized solutions for large organizations</p>
                    <p>Contact us for pricing</p>
                </div>
            </div>
        </div>
    </section>
  
    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>TeamUp is dedicated to helping teams work together efficiently and effectively. Our mission is to provide the best collaboration tools to businesses of all sizes.</p>
        </div>
    </section>
  
    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Email: info@teamup.com</p>
            <p>Phone: 123-456-7890</p>
            <p>Address: 123 Main Street, City, Country</p>
        </div>
    </section>
<?php 
    include 'footer.html';
?>

  
  
    </section>
    
    <script src="script.js"></script>
  </body>
</html>

