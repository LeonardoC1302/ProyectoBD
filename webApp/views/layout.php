<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabProSource</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Oswald:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="/" class="company-name">Labprosource</a>
        <div class="mobile-menu">
            <i class='bx bx-menu' ></i>
        </div>
        <nav class="navigation">
            <div class="header-links">
                <a href="/">Home</a>
                <a href="/products">Products</a>
                <a href="/contact">Contact</a>
                <a href="/about">About</a>
            </div>
            <div class="header-account">
                <a class="icon" href="/cart">
                    <i class='bx bx-cart' ></i>
                </a>
                <a class="icon" href="/account"> <!-- Change if its not logged in -->
                    <i class='bx bxs-user-circle'></i>
                </a>
            </div>
        </nav>
    </header>

    <div class="search-bar">
        <form action="/products" class="search-input">
            <input type="text" name="search" placeholder="Search on LabProSource">
            <button class="search-icon" type="submit">
                <i class='bx bx-search' ></i>
            </button>
        </form>
    </div>

    <?php echo $content; ?>

    <footer class="footer">
        <div class="logo">
            <picture>
                <source srcset="build/img/labLogo.webp" type="image/webp">
                <source srcset="build/img/labLogo.jpg" type="image/jpeg">
                <img class="logo-image" loading="lazy" src="build/img/labLogo.jpg" alt="Logo Image">
            </picture>
            <p class="logo-name">Labprosource</p>
        </div>

        <div class="footer-links">
            <p class="link-section">My Account</p>
            <a href="/login">Login/Register</a> <!-- Change if its logged in -->
            <a href="/account">Account Settings</a>
            <a href="/orders">Order History</a>
        </div>

        <div class="footer-links">
            <p class="link-section">Company Information</p>
            <a href="/about">About Us</a>
            <a href="/contact">Contact Us</a>
            <a href="/policies">Policies</a>
        </div>

        <div class="footer-links">
            <p class="link-section">How can we help?</p>
            <a href="/service">Customer Service</a>
            <a href="/returns">Returns</a>
            <a href="/apply">Apply for a job</a>
            
        </div>

        <div class="footer-links">
            <p class="link-section">Quick Links</p>
            <a href="/products">Our Products</a>
            <a href="/international">International Orders</a>
            <a href="/cart">Shopping Cart</a>
        </div>
    </footer>

    <script src="/build/js/app.js"></script>
</body>
</html>