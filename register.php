<?php
include "config.php"; // Assumes this file sets up $conn (database connection)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            die("All fields are required. <a href='register.html'>Try again</a>");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format. <a href='register.html'>Try again</a>");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Username or email already taken. <a href='register.html'>Try again</a>";
        } else {
            // Insert new user
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "Registration successful! <a href='login.html'>Login now</a>";
            } else {
                echo "Error: " . $stmt->error . " <a href='register.html'>Try again</a>";
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Missing required fields. <a href='register.html'>Try again</a>";
    }
} else {
    echo "Invalid request method. <a href='register.html'>Go back</a>";
}
?>
