<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - InnovateStack</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <div class="logo">InnovateStack</div>
        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="projects.php">Projects</a>
            <a href="contact.html">Contact</a>
            <a href="logout.php" class="login-btn">Logout</a>
        </nav>
    </header>
    <section class="projects-section">
        <div class="projects-container">
            <h2 class="slide-in">Explore Our Work</h2>
            <p class="fade-in">Welcome back, <?php echo htmlspecialchars($_SESSION["user"]); ?>! Here are your projects.</p>
            <div class="project-list">
                <div class="project-card fade-in">
                    <img src="taskmaster.png" alt="TaskMaster">
                    <h3>TaskMaster</h3>
                    <p>A task management web app built with PHP and MySQL to help teams organize workflows.</p>
                </div>
                <div class="project-card fade-in">
                    <img src="aichatbot.png" alt="AI Chatbot">
                    <h3>AI Chatbot</h3>
                    <p>An AI-powered chatbot using JavaScript and APIs for real-time user interaction.</p>
                </div>
                <div class="project-card fade-in">
                    <img src="datasync.png" alt="DataSync">
                    <h3>DataSync</h3>
                    <p>A database management system for syncing and analyzing project data efficiently.</p>
                </div>
            </div>
            <p class="login-prompt">Want to contribute? Start managing your projects now!</p>
        </div>
    </section>
    <footer>
        <p>©️ 2025 InnovateStack. All Rights Reserved.</p>
    </footer>
</body>

</html>