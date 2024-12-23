<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Your Project</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #6DA252;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .nav-links {
            display: flex;
            gap: 15px;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background: linear-gradient(120deg, #6DA252, #8BC34A);
            color: white;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .hero .cta {
            display: inline-block;
            padding: 15px 30px;
            background-color: white;
            color: #6DA252;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .hero .cta:hover {
            background-color: #f1f1f1;
            transform: scale(1.05);
        }

        /* Features Section */
        .features {
            padding: 50px 20px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .features h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #6DA252;
        }

        .features .feature-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .features .card {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 300px;
            transition: transform 0.3s;
        }

        .features .card:hover {
            transform: translateY(-5px);
        }

        .features .card img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .features .card h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #333;
        }

        .features .card p {
            font-size: 16px;
            color: #666;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #6DA252;
            color: white;
        }

        footer p {
            margin: 0;
        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Akaunting</div>
        <div class="nav-links">
            <a href="/auth/login">Login</a>
            <a href="/auth/register">Register</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to Your Project</h1>
        <p>Your one-stop solution for managing your business efficiently and effectively.</p>
        <a href="#features" class="cta">Learn More</a>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2>Features</h2>
        <div class="feature-cards">
            <div class="card">
                <img src="https://img.icons8.com/color/96/dashboard.png" alt="Dashboard Icon">
                <h3>Easy Dashboard</h3>
                <p>Track all your data and metrics in one place with an intuitive interface.</p>
            </div>
            <div class="card">
                <img src="https://img.icons8.com/color/96/sales-performance.png" alt="Sales Icon">
                <h3>Sales Tracking</h3>
                <p>Monitor your sales performance and gain insights into your growth.</p>
            </div>
            <div class="card">
                <img src="https://img.icons8.com/color/96/money.png" alt="Finance Icon">
                <h3>Financial Management</h3>
                <p>Manage invoices, payments, and budgets with ease.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Akaunting.</p>
    </footer>
</body>
</html>
