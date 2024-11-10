<?php
session_start();

require_once('../sign-up-page/_dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folder = "../assets/images/";

    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == 0) {
        $filename = basename($_FILES['uploadfile']['name']);
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $targetFilePath = $folder . $filename;

        if (move_uploaded_file($tempname, $targetFilePath)) {
            echo "File uploaded successfully.";
            header("Location: ./movers-dashboard.php");
        } else {
            echo "File upload failed.";
        }
    }

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userId = $_SESSION['user_id'];
    $sql_updt = "UPDATE users SET name = '$name', usr_img = '$targetFilePath', email = '$email', password = '$hashedPassword' WHERE id = $userId";
    $result = mysqli_query($conn, $sql_updt);

    if ($result) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Packers and Movers Dashboard</title>

    <style>
    
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap");

      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
      }

      body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        background-color: #f4f4f4;
        color: #333;
      }

      .main-content {
        flex: 1;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin: 20px;
      }

      h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #3498db;
        font-size: 3rem;
        font-weight: 500;
      }

      .header-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
      }

      .flex-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        margin: 0 auto;
      }

      .form-container,
      .image-container {
        flex: 1;
        max-width: 400px;
        border-radius: 8px;
        overflow: hidden;
        /* margin: 0 10px; */
        background-color: #ecf0f1;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      .form-container {
        margin-right: 20px; 
      }

      form {
        display: flex;
        flex-direction: column;
      }

      form label {
        margin-top: 10px;
        font-weight: bold;
      }

      form input {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #bdc3c7;
        border-radius: 4px;
        font-size: 14px;
      }

      form input[type="file"] {
        padding: 3px; 
      }

      button {
        padding: 10px;
        background-color: #63c462;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        margin-top: 20px; 
      }

      button:hover {
        background-color: #3498db;
      }

      .image-preview {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #bdc3c7;
      }

      .update-button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      @media (min-width: 520px) {
        .form-container,
        .image-container {
          margin: 0 10px;
        }
      }

      @media (max-width: 520px) {
        .flex-container {
          flex-direction: column; 
        }

        .form-container {
          margin-right: 0;
          margin-top: 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="main-content">
      <h1>Movers</h1>
      <div class="header-container">
        <h2>Profile</h2>
      </div>

      <div class="flex-container">
        <div class="image-container">
          <img id="imagePreview" class="image-preview" src="" alt="Image Preview" />
        </div>
        <div class="form-container">
          <form id="profileForm" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']) ?>" required />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
            <label for="imageUpload">Profile Image:</label>
            <input type="file" name="uploadfile" onchange="previewImage(event)" />
            <button type="submit" name="submit">Update Profile</button>
          </form>
        </div>
      </div>
    </div>

    <script>
      function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
          const imagePreview = document.getElementById("imagePreview");
          imagePreview.src = e.target.result;
        };
        if (file) {
          reader.readAsDataURL(file);
        }
      }
    </script>
  </body>
</html>
