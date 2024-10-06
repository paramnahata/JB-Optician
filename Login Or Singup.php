<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'optical_store'); // Update with your MySQL credentials

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Store the referring page before login
if (!isset($_SESSION['previous_page'])) {
  if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "login.php")) {
    // Avoid storing the login page itself as the previous page
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
  }
}

// Handle Sign-Up
if (isset($_POST['signup'])) {
  // Fetch and sanitize input data
  $full_name = trim($_POST['full_name']);
  $email = trim($_POST['email']);
  $mobile = trim($_POST['mobile']);
  $dob = trim($_POST['dob']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Server-side Validation
  $errors = [];

  // Full Name Validation
  if (!preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
    $errors[] = "Please enter a valid full name (letters and spaces only).";
  }

  // Email Validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
  }

  // Mobile Validation
  if (!preg_match("/^[0-9]{10}$/", $mobile)) {
    $errors[] = "Please enter a valid 10-digit mobile number.";
  }

  // DOB Validation
  if (empty($dob)) {
    $errors[] = "Please select your date of birth.";
  }

  // Password Validation
  if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters long.";
  }

  // Confirm Password Validation
  if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
  }

  // Check if email already exists
  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $errors[] = "Email is already registered.";
  }
  $stmt->close();

  if (empty($errors)) {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, mobile, dob, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $mobile, $dob, $hashed_password);

    if ($stmt->execute()) {
      echo "<script>alert('Registration Successful! You can now log in.');</script>";
    } else {
      echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
    }
    $stmt->close();
  } else {
    // Display errors
    foreach ($errors as $error) {
      echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
    }
  }
}

// Handle Login
if (isset($_POST['login'])) {
  // Fetch and sanitize input data
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Server-side Validation
  $errors = [];

  // Email Validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
  }

  // Password Validation
  if (empty($password)) {
    $errors[] = "Please enter your password.";
  }

  if (empty($errors)) {
    // Retrieve user from database using prepared statements
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $full_name, $hashed_password);
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->fetch();
      if (password_verify($password, $hashed_password)) {
        // Set session variables
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $full_name;

        // Redirect to the previous page if exists, otherwise to dashboard
        if (isset($_SESSION['previous_page'])) {
          $redirect_to = $_SESSION['previous_page'];
          unset($_SESSION['previous_page']); // Clear the session after redirection
        } else {
          $redirect_to = 'dashboard.php'; // Default to dashboard
        }

        header("Location: " . $redirect_to);
        exit();
      } else {
        $errors[] = "Incorrect password.";
      }
    } else {
      $errors[] = "User not found.";
    }
    $stmt->close();
  }

  if (!empty($errors)) {
    foreach ($errors as $error) {
      echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <title>Sign in & Sign up Form</title>
  <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- Sign In Form -->
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" name="login" value="Login" class="btn solid" />
        </form>

        <!-- Sign Up Form -->
        <form action="" method="POST" class="sign-up-form" id="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="full_name" id="full-name" placeholder="Full name" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-phone"></i>
            <input type="tel" name="mobile" id="mobile" placeholder="Mobile no." required />
          </div>
          <div class="input-field">
            <i class="fas fa-calendar"></i>
            <input type="date" name="dob" id="dob" placeholder="D.O.B" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm_password" id="confirm-password" placeholder="Repeat Password"
              required />
          </div>
          <input type="submit" name="signup" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here?</h3>
          <p>
            Welcome to our optical store! Sign up to explore our range of products.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>

      <div class="panel right-panel">
        <div class="content">
          <h3>One of us?</h3>
          <p>
            Already have an account? Log in to check your orders and profile.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });

    // Front-end Validation for Sign-Up form
    document.getElementById("sign-up-form").addEventListener("submit", function (event) {
      const fullName = document.getElementById("full-name").value;
      const nameRegex = /^[a-zA-Z\s]+$/;
      if (!nameRegex.test(fullName)) {
        alert("Please enter a valid full name (letters and spaces only).");
        event.preventDefault();
        return false;
      }

      const email = document.getElementById("email").value;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
      }

      const mobile = document.getElementById("mobile").value;
      const mobileRegex = /^[0-9]{10}$/;
      if (!mobileRegex.test(mobile)) {
        alert("Please enter a valid 10-digit mobile number.");
        event.preventDefault();
        return false;
      }

      const dob = document.getElementById("dob").value;
      if (dob === "") {
        alert("Please select your date of birth.");
        event.preventDefault();
        return false;
      }

      const password = document.getElementById("password").value;
      if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        event.preventDefault();
        return false;
      }

      const confirmPassword = document.getElementById("confirm-password").value;
      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
        return false;
      }
    });
  </script>
</body>

</html>