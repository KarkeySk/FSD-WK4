<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>

    <style>
        body {
            font-family: Arial;
            background: #f6f6f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 12px;
            color: white;
            background: #003c8f;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #002a6d;
        }
        .error {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .success {
            color: green;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>User Registration</h2>

    <!-- Show success or error messages -->
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="success">' . htmlspecialchars($_GET['success']) . '</div>';
    }
    if (isset($_GET['error'])) {
        echo '<div class="error" style="color: red; padding: 10px; margin-bottom: 20px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 6px; text-align: center;">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>

    <form action="register.php" method="POST" onsubmit="return validateForm()">

        <label>Name:</label>
        <input type="text" id="name" name="name">
        <div class="error" id="nameErr"></div>

        <label>Email:</label>
        <input type="email" id="email" name="email">
        <div class="error" id="emailErr"></div>

        <label>Password:</label>
        <input type="password" id="password" name="password">
        <div class="error" id="passErr"></div>

        <label>Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <div class="error" id="confirmErr"></div>

        <button type="submit">Register</button>
    </form>
</div>

<script>
// Inline JavaScript Validation
function validateForm() {

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let pass = document.getElementById("password").value.trim();
    let confirm = document.getElementById("confirm_password").value.trim();

    document.getElementById("nameErr").textContent = "";
    document.getElementById("emailErr").textContent = "";
    document.getElementById("passErr").textContent = "";
    document.getElementById("confirmErr").textContent = "";

    let valid = true;

    if (name === "") {
        document.getElementById("nameErr").textContent = "Name is required.";
        valid = false;
    }
    if (email === "") {
        document.getElementById("emailErr").textContent = "Email is required.";
        valid = false;
    }
    if (pass.length < 6) {
        document.getElementById("passErr").textContent = "Password must be at least 6 characters.";
        valid = false;
    }
    if (pass !== confirm) {
        document.getElementById("confirmErr").textContent = "Passwords do not match.";
        valid = false;
    }

    return valid;
}
</script>

</body>
</html>