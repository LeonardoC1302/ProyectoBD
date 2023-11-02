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
        <nav class="navigation">
            <div class="header-links">
                <a href="#">Home</a>
                <a href="#">Products</a>
                <a href="#">Contact</a>
                <a href="#">About</a>
            </div>
            <div class="header-account">
                <a class="icon" href="#">
                    <i class='bx bx-cart' ></i>
                </a>
                <a class="icon" href="#">
                    <i class='bx bxs-user-circle'></i>
                </a>
            </div>
        </nav>
    </header>

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
            <a href="#">Login/Register</a>
            <a href="#">Account Settings</a>
            <a href="#">Order History</a>
        </div>

        <div class="footer-links">
            <p class="link-section">Company Information</p>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Apply for a job</a>
        </div>

        <div class="footer-links">
            <p class="link-section">How can we help?</p>
            <a href="#">Customer Service</a>
            <a href="#">Returns</a>
            <a href="#">Quick Order</a>
        </div>

        <div class="footer-links">
            <p class="link-section">Quick Links</p>
            <a href="#">Our Products</a>
            <a href="#">International Orders</a>
            <a href="#">Policies</a>
        </div>
    </footer>
</body>
</html>