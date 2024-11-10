<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include  '../sign-up-page/_dbconnect.php';
    $F_Name = $_POST["name"];
    $email = $_POST["email"];
    $p_number = $_POST["phone"];
    $c_add = $_POST["current_address"];
    $d_add = $_POST["destination_address"];
    $distance = $_POST["distance"];
    $t_cost = $_POST["total-cost"];
    $sql_new =  "INSERT INTO `payment_info` (`Full_Name`, `email_address`, `phone_number`, `current_address`, `destination_address`, `total_distance`, `total_amount`) VALUES ('$F_Name', '$email', '$p_number','$c_add','$d_add','$distance','$t_cost');";
    $result_new = mysqli_query($conn, $sql_new);
    if ($result_new) {
        header("Location: ./payment-gateway.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Service</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            margin: 0 auto;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        .notice {
            font-size: 0.9em;
            color: #ff0000;
        }

        .total-cost {
            font-weight: bold;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            padding: 15px 0;
            color: #777;
            border-top: 1px solid #eaeaea;
        }
    </style>
    <script>

        window.onload = function () {
            const selectedPlan = sessionStorage.getItem("selectedPlan");
            if (selectedPlan) {
                document.getElementById('plan-info').textContent = `Plan selected : ${selectedPlan} plan.`;
                calculateCost(); 
            } else {
                alert("Please select a plan first.");
                window.location.href = 'movers-pricing.php'; 
            }
        };

        function calculateCost() {
            const distance = parseFloat(document.getElementById('distance').value) || 0;
            const selectedPlan = sessionStorage.getItem("selectedPlan");
            let costPerKm = 0;

            if (selectedPlan) {
                switch (selectedPlan) {
                    case 'Basic':
                        costPerKm = 300;
                        break;
                    case 'Standard':
                        costPerKm = 600;
                        break;
                    case 'Premium':
                        costPerKm = 1000;
                        break;
                }
            }

            const totalCost = distance * costPerKm;
            document.getElementById('total-cost').textContent = `Total Cost: ₹${totalCost}`;
            document.getElementById('hidden-total-cost').value = totalCost;
        }
    </script>
</head>

<body>

    <header>
        <h1>Movers Service</h1>
    </header>

    <div class="form-container">
        <h2>Request a Service</h2>
        <form action="/dashboard/service-request.php" method="POST" onsubmit="calculateCost();">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo ($_SESSION['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="current-address">Current Address</label>
                <input type="text" id="current-address" name="current_address" required>
            </div>
            <div class="form-group">
                <label for="destination-address">Destination Address</label>
                <input type="text" id="destination-address" name="destination_address" required>
            </div>
            <div class="form-group">
                <label for="distance">Enter the Total Distance (in km)</label>
                <input type="text" id="distance" name="distance" required oninput="calculateCost()">
                <div class="notice">Please enter the approximate distance using Google Maps, only +1 km can be accepted after the total distance.</div>
            </div>

            <input type="hidden" id="hidden-total-cost" name="total-cost">

            <div class="form-group" id="plan-info"></div>

            <div class="total-cost" id="total-cost" name="total-cost">Total Cost: ₹0</div>
            
            <div class="form-group">
                <label for="details">Additional Details</label>
                <textarea id="details" name="details" rows="4"></textarea>
            </div>
            <button type="submit">Proceed</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Movers. All rights reserved.</p>
    </footer>

</body>

</html>
