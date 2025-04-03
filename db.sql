CREATE DATABASE term_project_db;
USE term_project_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);

CREATE DATABASE IF NOT EXISTS 'term_project_db' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE 'term_project_db';