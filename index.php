<?php
session_start();
$loggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JB Opticals</title>
    <link rel="icon" type="image/x-icon" href="favicon-16x16.png">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header&footer.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            z-index: 1000;
        }

        .popup-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            width: 60%;
            border-radius: 10px;
            text-align: center;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
        }

        .popup-logo {
            width: 150px;
        }

        .popup-deals {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .deal-card {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            width: 30%;
        }

        .popup-login {
            margin-top: 20px;
        }

        .popup-login input {
            width: 70%;
            margin-bottom: 10px;
        }

        .privacy-text {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="menu-icon" onclick="openMenu()">☰</div>

        <!-- Wrap logo and website name in a container -->
        <div class="brand-container">
            <a class="navbar-brand" href="index.html">
                <img src="logo.png" alt="Logo">
            </a>
            <div class="website-name">JB Opticals</div>
        </div>
        <!-- Profile Drop-down Menu -->
        <div class="profile">
            <img id="profilePic" class="profile-icon"
                style="border-radius: 50%; width: 40px; height: 40px; cursor:pointer;" onclick="toggleDropdown()">
            <ul class="dropdown-menu" id="profileDropdown">
                <li onclick="window.location.href='settings.html'">Settings</li>
                <li onclick="window.location.href='Login Or Singup.php'">Login / Sign Up</li>
                <li onclick="logout()">Logout</li>
            </ul>
        </div>
    </header>

    <!-- Popup for Discounts -->
    <div id="discountPopup" class="popup-overlay" style="display: <?php echo $loggedIn ? 'none' : 'block'; ?>;">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <div class="popup-header">
                <img src="logo.png" alt="GOEYE Logo" class="popup-logo">
                <h2>Welcome! Shop now to avail the best deals!</h2>
            </div>
            <div class="popup-deals">
                <div class="deal-card">
                    <p>BUY 1 GET 2nd UP TO 50% OFF</p>
                    <span>Use code: GO50</span>
                </div>
                <div class="deal-card">
                    <p>Get flat ₹100 off on your first purchase</p>
                    <span>Use code: GO100</span>
                </div>
                <div class="deal-card">
                    <p>Flat 10% instant discount on OneCard</p>
                    <span>Use code: ONECARD10</span>
                </div>
            </div>
            <div class="popup-login">
                <h3>Unlock Superior Discounts</h3>
                <input type="text" class="form-control" placeholder="Enter Mobile Number" />
                <button class="btn btn-success">WhatsApp Login</button>
                <p class="privacy-text">By proceeding, you accept our <a href="#">Privacy Policy</a> and <a
                        href="#">Terms</a>.</p>
            </div>
        </div>
    </div>

    <!-- Side Menu -->
    <div id="sideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="index.html">Home</a>
        <a href="about.html">About Us</a>
        <a href="product.html">Shop</a>
        <a href="Q&A.html">Help Center</a>
        <a href="contact.html">Contact</a>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Discover Your Style</h1>
        <p>Find the perfect pair of spectacles</p>
        <a href="product.html" class="btn-primary">Shop Now</a>
    </section>

    <!-- Featured Products Section -->
    <section class="products">
        <h2>Featured Products</h2>
        <div class="product-list" id="product-list"></div>
    </section>

    <!-- "We Also Sell" Section -->
    <section class="we-also-sell">
        <h2>We Also Sell</h2>
        <div class="round-icons">
            <div class="icon-item" onclick="window.location.href='contact-lenses.html'">
                <img src="contactlens.png" alt="Contact Lenses">
            </div>
            <div class="icon-item" onclick="window.location.href='sunglasses.html'">
                <img src="sunglass.png" alt="Sunglasses">
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <div class="mt-4">
        <h2>Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-cogs fa-3x"></i>
                        <h5 class="card-title">High Quality</h5>
                        <p class="card-text">Our products are made with the highest quality materials.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x"></i>
                        <h5 class="card-title">Free Shipping</h5>
                        <p class="card-text">Enjoy free shipping on all orders. (Within India Only)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-headset fa-3x"></i>
                        <h5 class="card-title">24/7 Support</h5>
                        <p class="card-text">We're here to help you anytime, day or night.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-star fa-3x"></i>
                        <h5 class="card-title">Satisfaction Guaranteed</h5>
                        <p class="card-text">We offer a satisfaction guarantee on all our products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="yt">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/8DTALnlV4Qw?si=P_qgay_S9spU5ynF"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/nTFmKmYqBjw?si=z4B3jVg4L4yBMD7w"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    </section>

    <!-- Contact Us on WhatsApp -->
    <a href="https://wa.me/yourwhatsappnumber" class="contact-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>JB Optical</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Share Your Prescription</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Return / Exchange Policy</a></li>
                    <li><a href="#">Track Your Order</a></li>
                    <li><a href="#">Frame Guide</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Information</h4>
                <ul>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Get in Touch</h4>
                <ul>
                    <li><a href="mailto:info@jbopticals.com">Email Us</a></li>
                    <li><a href="#">Return / Exchange Center</a></li>
                </ul>
                <div class="social-icons">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section newsletter">
            <iframe width="540" height="305" src="https://cfb19dba.sibforms.com/serve/MUIFAM-lvrrt_seYA6VFtnAUL_bw5tqyC23x6LcRI3gFXbuFHJySDskunCTyXXXbrkBG_cSKDJBHH-Ic6jr_p83c-zbvnVpXQEDmlWxgssyVHo-tqV3kwZKmmtdBUFtNnYLoPnif38vkHPR2VI-up_07S8NUzSH0Zr__Ss5WgbzjN7hJtdxKSRJZ_h1sR7GA718wNaO5IeR4Cf5P" frameborder="0" scrolling="auto" allowfullscreen style="display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 JB Optical | All Rights Reserved</p>
        </div>
    </footer>
    <!-- Bottom Navigation for Mobile -->
    <nav class="navigation">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="product.html">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        window.onload = function () {
            // Show discount popup only if user is not logged in
            const discountPopup = document.getElementById("discountPopup");
            if (discountPopup && !<?php echo json_encode($loggedIn); ?>) {
                discountPopup.style.display = "block";
            }

            // Load profile photo from cookie
            const profilePicUrl = getCookie('profilePic');
            if (profilePicUrl) {
                document.getElementById('profilePic').src = profilePicUrl;
            }

            // Open a different popup (if necessary)
            const offerPopup = document.getElementById("offerPopup");
            if (offerPopup && !<?php echo json_encode($loggedIn); ?>) {
                offerPopup.style.display = "block";
            }
        };

        // Close the popup
        function closePopup() {
            const discountPopup = document.getElementById("discountPopup");
            if (discountPopup) {
                discountPopup.style.display = "none";
            }
        }

        // Function to get cookies
        function getCookie(name) {
            let cookieArr = document.cookie.split(";");
            for (let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");
                if (name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        // Dropdown toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('active');
        }

        // Open and close side menu
        function openMenu() {
            document.getElementById("sideMenu").style.width = "250px";
        }

        function closeMenu() {
            document.getElementById("sideMenu").style.width = "0";
        }

        // Logout function
        function logout() {
            alert("Logging out...");
            location.reload();
        }
    </script>
</body>

</html>
