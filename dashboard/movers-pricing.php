<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
    header("location: ../sign-up page/login-page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Pricing Table</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sono', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        header {
            background-color: #63c462;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        h2 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
        }

        .pricing-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            flex-wrap: wrap;
        }

        .pricing-plan {
            flex: 1;
            max-width: 350px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .pricing-plan:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .plan-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #e74c3c;
        }

        .plan-price {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #2980b9;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            text-align: center;
        }

        .plan-features li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .plan-button {
            cursor: pointer;
            padding: 8px;
            background-color: #ea9423;
            color: #ffffff;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .plan-button:hover {
            background-color: #787c7f;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 15px 0;
            color: #777;
            border-top: 1px solid #eaeaea;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 2.5rem;
            }

            .pricing-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .pricing-plan {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Movers Pricing</h1>
    </header>

    <h2>Our Plans</h2>

    <div class="pricing-container">
        <div class="pricing-plan">
            <div class="plan-title">Basic</div>
            <div class="plan-price"><span>₹</span>300/km</div>
            <ul class="plan-features">
                <li>✅ Local Moving</li>
                <li>🚫 Packing Service</li>
                <li>🚫 Special Item Handling</li>
            </ul>
            <input class="plan-button" onclick="placeOrder('Basic')" type="button" value="Select">
        </div>

        <div class="pricing-plan">
            <div class="plan-title">Standard</div>
            <div class="plan-price"><span>₹</span>600/km</div>
            <ul class="plan-features">
                <li>✅ Local Moving</li>
                <li>✅ Packing Services</li>
                <li>🚫 Special Item Handling</li>
            </ul>
            <input class="plan-button" onclick="placeOrder('Standard')" type="button" value="Select">
        </div>

        <div class="pricing-plan">
            <div class="plan-title">Premium</div>
            <div class="plan-price"><span>₹</span>1000/km</div>
            <ul class="plan-features">
                <li>✅ Local Moving</li>
                <li>✅ Packing Services</li>
                <li>✅ Special Item Handling</li>
            </ul>
            <input class="plan-button" onclick="placeOrder('Premium')" type="button" value="Select">
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Movers. All rights reserved.</p>
    </footer>

    <script>
        function placeOrder(plan) {
            sessionStorage.setItem("selectedPlan", plan);
            window.location.href = "service-request.php";
        }
    </script>

</body>

</html>
