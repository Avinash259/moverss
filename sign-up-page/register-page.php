<?php
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include  './_dbconnect.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql =  "SELECT * FROM USERS WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num >= 1){
      echo "Email Already Exists!";
    }
    elseif($num == 0){
      $sql_new =  "INSERT INTO `users` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email', '$hashedPassword', current_timestamp());";
      $result_new = mysqli_query($conn, $sql_new);
      header("Location: ./login-page.php");
    }
    else {
      $showAlert = "Registration failed. Please try again.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movers-sign-up-page</title>

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;700&display=swap");

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
      }

      body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url(./1234567.jpg) no-repeat;
        background-size: cover;
        background-position: center;
        padding: 10px;
      }

      .wrapper {
        position: relative;
        width: 100%;
        max-width: 370px;
        min-width: 330px;
        height: auto;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 20px;
        backdrop-filter: blur(20px);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
      }

      .form-box {
        width: 100%;
        padding: 25px;
      }

      .form-box h2 {
        font-size: 1.8em;
        font-weight: 500;
        color: #162938;
        text-align: center;
      }

      .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        border-bottom: 2px solid #162938;
        margin: 30px 0;
      }

      .input-box label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-10px);
        font-size: 1em;
        color: #323d49;
        font-weight: 500;
        pointer-events: none;
        transition: 0.5s;
      }

      .input-box input:focus ~ label,
      .input-box input:valid ~ label {
        top: -5px;
      }

      .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        color: #162938;
        font-weight: 600;
      }

      .input-box .icon {
        position: absolute;
        right: 8px;
        font-size: 1.2em;
        color: #162938;
        line-height: 57px;
      }

      .remember-forgot {
        font-size: 0.9em;
        color: #162938;
        font-weight: 500;
        margin: -15px 0 15px;
        display: flex;
        justify-content: space-between;
      }

      .remember-forgot label input {
        accent-color: #162938;
        margin-right: 3px;
      }

      .remember-forgot a {
        color: #162938;
        text-decoration: none;
      }

      .remember-forgot a:hover {
        text-decoration: underline;
      }

      .btn {
        width: 100%;
        height: 45px;
        background: #162938;
        border: none;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        color: white;
        font-size: 1em;
        font-weight: 500;
      }

      .login-register {
        font-size: 0.9em;
        text-align: center;
        font-weight: 500;
        margin: 25px 0 10px;
      }

      .login-register p a {
        color: #162938;
        text-decoration: none;
        font-weight: 600;
      }

      .login-register p a:hover {
        text-decoration: underline;
      }

      span a {
        font-weight: 700;
      }

      @media (max-width: 400px) {
        .form-box h2 {
          font-size: 1.5em;
        }
        .input-box input {
          font-size: 0.9em;
        }
        .btn {
          font-size: 0.9em;
        }
      }
    </style>
  </head>
  <body>

    <div class="wrapper">
      <div class="form-box register">
        <h2>Registration</h2>
        <?php if ($showAlert): ?>
                <p style="color:red;"><?php echo $showAlert; ?></p>
        <?php endif; ?>
        <form action="/sign-up-page/register-page.php" method="post">
          <div class="input-box">
            <span class="icon"><ion-icon name="person"></ion-icon></span>
            <input type="text" id = "username" name= "username" required />
            <label>Username</label>
          </div>
          <div class="input-box">
            <span class="icon"><ion-icon name="mail"></ion-icon></span>
            <input type="email" id = "email" name= "email" required />
            <label>Email</label>
          </div>
          <div class="input-box">
            <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
            <input type="password" id = "password" name= "password" required />
            <label>Password</label>
          </div>
          <div class="remember-forgot">
            <label>
              <input type="checkbox" /> I agree to the
              <span><a href="./terms&condition.html">Terms & Conditions</a></span>.
            </label>
          </div>

          <button type="submit" class="btn">Register</button>

          <div class="login-register">
            <p>
              Already have an account?
              <a href="./login-page.php" class="login-link">Login</a>
            </p>
          </div>
        </form>
      </div>
    </div>

    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
