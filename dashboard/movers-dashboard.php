<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false){
    header("Location: ../sign-up-page/login-page.php");
    exit();
}
require_once('../sign-up-page/_dbconnect.php');
$userId = $_SESSION['user_id']; 
$sql = "SELECT name, email, usr_img FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $name = htmlspecialchars($user['name']);
    $email = htmlspecialchars($user['email']);
    $profileImage = $user['usr_img']; 
} else {
    $name = "User";
    $email = "Not available";
    $profileImage = "path_to_default_image.jpg";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard - Packers and Movers</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <style>
        body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
      }
      .sidebar {
        width: 220px;
        min-height: 100vh;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 1000;
      }
      .sidebar.visible {
        transform: translateX(0);
      }
      .close-btn {
        position: fixed;
        top: 4%;
        right: 0;
        font-size: 35px;
        padding: 5px;
        cursor: pointer;
        background: none;
        border: none;
        margin-bottom: 20px;
        color: #333;
      }

      .log-out-btn a {
        text-decoration: none;
        background: #3498db;
        font-size: medium;
        color: #ffffff;
        padding: 4px;
        border-radius: 5px;
      }

      .log-out-btn a:hover {
        background: rgb(195, 190, 190);
        color: #ffffff;
      }

      .sidebar h3 {
        text-align: center;
        font-weight: 600;
        margin-bottom: 20px;
        color: #444;
      }
      .sidebar ul {
        list-style-type: none;
        padding: 0;
      }
      .sidebar li {
        margin: 10px 0;
      }
      .sidebar a {
        text-decoration: none;
        color: #333;
        padding: 10px;
        display: block;
        border-radius: 4px;
        transition: background-color 0.3s;
      }
      .sidebar a:hover {
        background-color: #f0f0f0;
      }
      .main-content {
        flex-grow: 1;
        padding: 20px;
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        background-color: #f8f9fa;
      }
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }
      .hamburger {
        display: none;
        cursor: pointer;
        font-size: 28px;
      }

      h1 {
        color: #8a8685;
      }

      .quick-stats,
      .recent-activities {
        margin: 20px 0;
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }
      .activity-list {
        list-style-type: none;
        padding: 0;
      }
      .activity-list li {
        background-color: #f1f1f1;
        padding: 15px;
        margin: 5px 0;
        border-radius: 4px;
        transition: transform 0.2s;
      }
      .activity-list li:hover {
        transform: scale(1.02);
      }

      @media (max-width: 700px) {
        .sidebar {
          width: 30%;
          position: fixed;
          left: 0;
          top: 0;
          z-index: 1000;
        }
        .main-content {
          margin-left: 0;
        }
        .hamburger {
          display: block;
        }
      }

      @media (min-width: 700px) {
        .sidebar {
          transform: translateX(0);
        }
        .main-content {
          margin-left: 250px;
        }
        .close-btn {
          display: none;
        }
      }

      .profile-display {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
      }

      .profile-display img {
        max-width: 210px;
        height: 210px;
        border-radius: 50%;
        border: 1px solid #bdc3c7;
        margin-bottom: 10px;
      }

      h2 {
        color: #3498db;
        margin-bottom: 20px;
      }

      #button1 {
        padding: 10px 20px;
        background-color: #63c462;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
        transition: background-color 0.3s;
      }

      #button1:hover {
        background-color: #3498db;
      }

      @media (min-width: 700px) {
        .profile-display {
          display: flex;
          align-items: center;
          justify-content: space-around; 
        }
        .profile-display img {
          margin: 0 20px; 
        }
      }

      @media (max-width: 700px) {
        .profile-display {
          flex-direction: column; 
        }
      }
    </style>
</head>
<body>
    <nav class="sidebar" id="sidebar">
        <button class="close-btn" id="close-btn">&times;</button>
        <h3>MOVERS</h3>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="./service-request.php">New Booking</a></li>
            <li><a href="./update-profile.php">Profile Settings</a></li>
            <li><a href="./help&support.html">Help & Support</a></li>
            <li><a href="/dashboard/movers-pricing.php">Check Pricing</a></li>
        </ul>
    </nav>

    <main class="main-content" id="main-content">
        <div class="header">
            <div class="hamburger" id="hamburger">&#9776;</div>
            <h1 id="welcomeMessage">Welcome, <?php echo $name; ?>!</h1>
            <div class="log-out-btn">
                <a href="../sign-up-page/logout.php"><span>Logout</span></a>
            </div>
        </div>

        <section>
            <div class="profile-display">
                <img id="profileImage" src="<?php echo $profileImage; ?>" alt="Profile Image" />
                <div>
                    <h2>Profile</h2>
                    <p><strong>Name: <?php echo $name; ?></strong></p>
                    <p><strong>Email: <?php echo $email; ?></strong></p>
                    <button id="button1" onclick="window.location.href='update-profile.php'">
                        Update Profile
                    </button>
                </div>
            </div>
        </section>

        <section class="quick-stats">
            <h2>Your Recent Activities</h2>
            <ul class="activity-list">
                <li>Booking confirmed - Order #12345</li>
                <li>Service request submitted for moving items</li>
                <li>Payment received for Order #12344</li>
            </ul>
        </section>
    </main>

    <script>
        const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebar");
        const closeBtn = document.getElementById("close-btn");

        const toggleSidebar = () => {
            sidebar.classList.toggle("visible");
        };

        hamburger.addEventListener("click", toggleSidebar);
        closeBtn.addEventListener("click", toggleSidebar);

        // Close sidebar when clicking outside
        document.addEventListener("click", (event) => {
            if (
                !sidebar.contains(event.target) &&
                !hamburger.contains(event.target) &&
                sidebar.classList.contains("visible")
            ) {
                sidebar.classList.remove("visible");
            }
        });
    </script>
</body>
</html>
