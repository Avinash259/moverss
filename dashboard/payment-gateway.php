<?php 
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    header("Location: ../sign-up-page/login-page.php");
    exit();
}

require_once('../sign-up-page/_dbconnect.php');

// Check database connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Query for user data
$sql = "SELECT * FROM `payment_info` WHERE email_address = '" . $_SESSION['email'] . "'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $name = htmlspecialchars($user['Full_Name']);
    $email = htmlspecialchars($user['email_address']);
    $address = htmlspecialchars($user['current_address']);
} else {
    $name = "User";
    $email = "Not available";
    $address = "Not available";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folder = "../assets/payment-screenshots/";

    if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['payment_image']['name']);
        $tempname = $_FILES['payment_image']['tmp_name'];
        $targetFilePath = $folder . $filename;

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tempname, $targetFilePath)) {
            echo "File uploaded successfully.";
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "File upload error: ";
        echo isset($_FILES['payment_image']['error']) ? $_FILES['payment_image']['error'] : 'No file uploaded.';
    }
}
else{
    echo "no connectioon";
}
// Sanitize and validate POST data before using it
$city = isset($_POST["city"]) ? mysqli_real_escape_string($conn, $_POST["city"]) : '';
$state = isset($_POST["state"]) ? mysqli_real_escape_string($conn, $_POST["state"]) : '';
$zipcode = isset($_POST["zipcode"]) ? mysqli_real_escape_string($conn, $_POST["zipcode"]) : '';
$pmt_mtd = isset($_POST["payment_method"]) ? mysqli_real_escape_string($conn, $_POST["payment_method"]) : '';

if ($city && $state && $zipcode && $pmt_mtd && isset($targetFilePath)) {
    $sql_new =  "INSERT INTO `payment_info` (`city`, `state`, `zipcode`, `pmt_opt`, `pmt_img`) 
                 VALUES ('$city', '$state', '$zipcode', '$pmt_mtd', '$targetFilePath')";
    if (mysqli_query($conn, $sql_new)) {
        echo "Payment information saved successfully.";
    } else {
        echo "ERROR: Could not execute $sql_new. " . mysqli_error($conn);
    }
} else {
    echo "Some fields are missing.";
}

mysqli_close($conn);
?>


 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Styles omitted for brevity */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Allows wrapping of sections */
        }
        .form-section {
            width: 48%; /* Each section takes half the container */
            margin: 0 1%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        select,
        input[type="file"] {
            width: 100%; /* Set width to 100% */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; /* Ensures padding is included in the width */
            margin: 0 auto; /* Centers the input box */
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
        .qr-code {
            display: none; /* Initially hidden */
            margin-top: 20px;
            text-align: center;
        }
        .message {
            display: none; /* Initially hidden */
            color: #ff0000;
            margin-top: 10px;
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            padding: 15px 0;
            color: #777;
            border-top: 1px solid #eaeaea;
        }

        /* Media Query for screen sizes below 500px */
        @media (max-width: 550px) {
            .form-section {
                width: 100%; /* Full width on smaller screens */
                margin: 10px 0; /* Margin for separation */
            }
            .form-container {
                flex-direction: column; /* Stack sections vertically */
            }
        }
    </style>
    <script>
        function toggleQRCode() {
            const qrCodeContainer = document.getElementById('qr-code');
            const cashMessage = document.getElementById('cash-message');
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            if (paymentMethod === 'upi') {
                qrCodeContainer.style.display = 'block';
                cashMessage.style.display = 'none';
            } else {
                qrCodeContainer.style.display = 'block';
                cashMessage.style.display = 'block';
            }
        }
    </script>
</head>
<body>

<div class="form-container">
    <div class="form-section">
        <h2>Billing Address</h2>
        <form action="/dashboard/payment-gateway.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo $name;?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $address;?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zip Code</label>
                <input type="text" id="zipcode" name="zipcode" required>
            </div>
    </div>

    <div class="form-section">
        <h2>Payment</h2>
        <div class="form-group payment-option">
            <label>Select Payment Method</label>
            <input type="radio" name="payment_method" value="cod" onclick="toggleQRCode()"> Cash on Delivery
            <br>
            <input type="radio" name="payment_method" value="upi" onclick="toggleQRCode()"> UPI
        </div>
        <div class="qr-code" id="qr-code">
            <h3>Scan the QR Code to Pay</h3>
            <img src="./why.jpg" alt="QR Code" width="200">
        </div>
        <div class="message" id="cash-message">
            <p>10% of the total fee is needed for the Cash on Delivery option.</p>
        </div>
        
        <h2>Attachment</h2>
        <div class="form-group">
            <label for="payment-image">Attach the Screenshot of Payment</label>
            <input type="file" id="payment-image" name="payment_image" accept="image/*" required>
        </div>
        <button type="submit">Submit Payment</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Movers. All rights reserved.</p>
</footer>

</body>
</html>
