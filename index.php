<?php ?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TeamUp</title>
    <link rel="website icon" type="png" href="pic/web-logo2.png">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>

    <header class="header" style="padding-left: 0px; padding-right: 0px;">
        <nav class="nav">
            <a href="index.php" class="nav_logo"><img src="pic/logo2.png" alt="TeamUp's Logo" style="height: 50px; width: auto;" /></a>

            <ul class="nav_items">
                <li class="nav_item">
                    <a href="#services" class="nav_link">Services</a>
                    <a href="#pricing" class="nav_link">Pricing</a>
                    <a href="#about" class="nav_link">About Us</a>
                    <a href="#contact" class="nav_link">Contact</a>
                </li>
            </ul>

            <button class="button" id="form-open">Login</button>

        </nav>
    </header>

    <!-- Home -->
    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- Login From -->

            <div class="form login_form">
                <form action="database/authenticate.php" method="post">
                    <h2>Login</h2>

                    <div class="input_box">
                        <input type="email" name="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>

                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check" />
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" id="forget">Forgot password?</a>
                    </div>

                    <button class="button">Login Now</button>

                    <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>

                </form>
            </div>
            <!-- Signup From -->
            <form action="database/insert.php" method="post">
                <div class="form signup_form">
                    <form action="#">
                        <h2>Signup</h2>

                        <div class="input_box">
                            <input type="text" name="name" placeholder="Enter your name" required />
                            <i class="uil uil-text text"></i>
                        </div>
                        <div class="input_box">
                            <input type="email" name="email" placeholder="Enter your email" required />
                            <i class="uil uil-envelope-alt email"></i>
                        </div>
                        <div class="input_box">
                            <input type="password" name="password" placeholder="Create password" required />
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>
                        <div class="input_box">
                            <input type="password" name="repassword" placeholder="Confirm password" required />
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>

                        <button class="button">Signup Now</button>

                        <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
                    </form>
                </div>
            </form>
            <!--forget password-->
            <div class="forget_form">
                <form>
                    <h2><a href="#" id="back" class="previous round">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Password</h2>

                    <div class="input_box">
                        <input type="email" name="email" id="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>

                    <button class="button" id="passforget" type="submit">Send</button>

                </form>
            </div>
            <!-- otp-forget -->
            <div class="forgetotp_form">
                <form>
                    <div class="input_box">
                        <input type="number" id="number" placeholder="Enter your otp" required />
                    </div>

                    <button class="button" id="otpsubmit" type="submit">Submit</button>

                </form>
            </div>
            <!-- reset password -->
            <form>
                <div class="form reset_form">
                    <form action="database/update.php" method="post">
                        <h2>Reset Password</h2>

                        <div class="input_box">
                            <input type="password" name="password" id="password" placeholder="Create password" required />
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>
                        <div class="input_box">
                            <input type="password" name="repassword" id="repassword" placeholder="Confirm password" required />
                            <i class="uil uil-lock password"></i>
                            <i class="uil uil-eye-slash pw_hide"></i>
                        </div>

                        <button class="button" id="change">Change</button>
                    </form>
                </div>
            </form>
        </div>
        <section class="hero">
            <div class="container" style="color: black;">
                <h2><br />Welcome to TeamUp</h2>
                <p>Your platform for collaboration and teamwork.</p>
                <!-- <button class="button" id="form-open">Login</button> -->
                <button class="button" id="form-open">Get Started</button>

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
                <p>TeamUp is dedicated to helping teams work together efficiently and effectively.</p><p>Our mission is to provide the best collaboration tools to businesses of all sizes.Have Great Day!!</p>
            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <p>Email: info@teamup.com</p>
                <p>Phone: 123-456-7890</p>
                <p>Address: Mota Bazaar, Vallabh Vidyanagar, Anand, Gujarat :388120</p>
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <p>&copy; 2024 TeamUp. All rights reserved.</p>
            </div>
</footer>
    </section>
    <script src="js/script.js"></script>
</body>

</html>