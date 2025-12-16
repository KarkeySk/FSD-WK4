<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Extra validation on server side
    if (empty($name) || empty($email) || empty($password) || $password !== $confirm) {
        echo "<h2>Invalid submission</h2>";
        exit;
    }

    $jsonFile = "users.json";
    
    // Check if file exists and is writable, or if directory is writable for new file
    if (file_exists($jsonFile)) {
        // Check if existing file is writable
        if (!is_writable($jsonFile)) {
            echo "<h2>Error: users.json file is not writable. Please check file permissions.</h2>";
            exit;
        }
    } else {
        // Check if directory is writable to create new file
        $directory = dirname($jsonFile);
        if ($directory === '.') {
            $directory = getcwd();
        }
        
        if (!is_writable($directory)) {
            echo "<h2>Error: Directory ($directory) is not writable. Cannot create users.json file.</h2>";
            exit;
        }
    }

    // Create file if not exists
    if (!file_exists($jsonFile)) {
        $result = file_put_contents($jsonFile, "[]");
        if ($result === false) {
            echo "<h2>Error: Failed to create users.json file.</h2>";
            exit;
        }
    }

    // Load existing users
    $data = file_get_contents($jsonFile);
    if ($data === false) {
        echo "<h2>Error: Cannot read users.json file.</h2>";
        exit;
    }
    
    $users = json_decode($data, true);

    if (!is_array($users)) {
        $users = [];
    }

    // Secure hashed password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Add new user
    $users[] = [
        "name" => $name,
        "email" => $email,
        "password" => $hashedPassword
    ];

    // Save to JSON with error checking
    $result = file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT));
    if ($result === false) {
        echo "<h2>Error: Failed to save user data to file.</h2>";
        exit;
    }

    // OUTPUT ONLY THIS (as you requested)
    echo "<h1>Registered Successfully!</h1>";
    exit;
}
?>