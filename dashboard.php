<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Prepare and execute query
        $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password_hash);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $password_hash)) {
                $_SESSION["user"] = $username;
                $_SESSION["user_id"] = $id;
                header("Location: projects.html");
                exit();
            } else {
                echo "Invalid password. <a href='login.html'>Try again</a>";
            }
        } else {
            echo "Username not found. <a href='login.html'>Try again</a>";
        }

        $stmt->close();
    } else {
        echo "Missing username or password. <a href='login.html'>Go back</a>";
    }
} else {
    echo "Invalid request method. <a href='login.html'>Go back</a>";
}

$conn->close();
