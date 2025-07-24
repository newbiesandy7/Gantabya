<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    :root {
        --primary-color: #6D9773;
        --dark-accent: #0C3B2E;
        --button-color: #BB8A52;
        --highlight-color: #FFBA00;
        --text-color: #333;
        --background-light: #f8f8f8;
        --container-bg: #fff;
        --border-color: #e0e0e0;
    }
    .footer-7-travel {
        background-color: var(--dark-accent);
        color: #fff;
        padding: 60px 0 20px;
        font-size: 0.9em;
    }
    .footer-7-travel .container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 0 20px;
    }
    .footer-7-travel .footer-col {
        flex: 1;
        min-width: 200px;
        margin-bottom: 30px;
        padding-right: 20px;
        box-sizing: border-box;
    }
    .footer-7-travel .logo-column {
        flex: 1.5;
        max-width: 300px;
    }
    .footer-7-travel .list-column {
        flex: 1;
        max-width: 200px;
    }
    .footer-7-travel .footer-col:last-child {
        padding-right: 0;
    }
    .footer-7-travel .footer-logo {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 15px;
        color: #fff;
    }
    .footer-7-travel .footer-logo img {
        max-width: 100%;
        height: auto;
        vertical-align: middle;
    }
    .footer-7-travel p {
        line-height: 1.8;
        color: #bbb;
        font-size: 0.9em;
    }
    .footer-7-travel h4 {
        font-size: 1.1em;
        margin-bottom: 20px;
        color: #fff;
        font-weight: normal;
    }
    .footer-7-travel ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-7-travel ul li {
        margin-bottom: 10px;
    }
    .footer-7-travel ul li a {
        color: #bbb;
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 700 !important;
        font-family: "Poppins", sans-serif;
    }
    .footer-7-travel ul li a:hover {
        color: var(--highlight-color);
    }
    .footer-7-travel .social-contact-col {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: flex-start;
    }
    .footer-7-travel .social-icons {
        margin-bottom: 20px;
        display: flex;
    }
    .footer-7-travel .social-icons a {
        color: #fff;
        font-size: 1.2em;
        margin-left: 15px;
        transition: color 0.3s ease;
    }
    .footer-7-travel .social-icons a:hover {
        color: var(--highlight-color);
    }
    .footer-7-travel .hotel-partner-btn {
        background: linear-gradient(90deg, #FFBA00 0%, #BB8A52 100%);
        color: #fff;
        border: none;
        padding: 14px 32px;
        border-radius: 30px;
        cursor: pointer;
        font-size: 1.1em;
        font-weight: bold;
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        letter-spacing: 1px;
        transition: background 0.3s, transform 0.2s;
        margin-top: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    .footer-7-travel .hotel-partner-btn:hover {
        background: linear-gradient(90deg, #BB8A52 0%, #FFBA00 100%);
        color: var(--dark-accent);
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .footer-7-travel .footer-bottom {
        text-align: center;
        margin-top: 50px;
        padding-top: 20px;
        border-top: 1px solid var(--primary-color);
        color: #bbb;
    }
</style>
<footer class="footer-7-travel">
    <div class="container">
        <div class="footer-col logo-column">
            <div class="footer-logo">
                <img src="img/whitelogo_wt-removebg.png" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <p>Your journey starts here. Discover breathtaking destinations, find amazing deals, and create unforgettable memories with us.</p>
        </div>
        <div class="footer-col list-column">
            <h4></h4> <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="blog.php">blogs</a></li>
                <li><a href="all-treks.php">Destinations</a></li>
                <li><a href="booksans/browse.php">Hotels</a></li>
            </ul>
        </div>
        <div class="footer-col list-column">
            <h4></h4> <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="blog.php">Blog</a></li>
            </ul>
        </div>
        <div class="footer-col list-column">
            <h4></h4> <ul>
                <li><a href="contact.php">FAQs</a></li>
            </ul>
        </div>
        <div class="footer-col social-contact-col">
            <div class="social-icons">
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Google Plus"><i class="fab fa-google-plus-g"></i></a>
            </div>
            <a href="./booksans/hotel_manager/register.php" class="hotel-partner-btn">Become Our Hotel Partner</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 gantabya. All Rights Reserved.</p>
    </div>
</footer>