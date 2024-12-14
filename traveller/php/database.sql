-- Create Database
CREATE DATABASE travel_guide;

-- Use the Database
USE travel_guide;

-- Create Table for Guides
CREATE TABLE guide_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    bio TEXT NOT NULL,
    experience INT NOT NULL,
    rate_per_hour DECIMAL(10, 2) NOT NULL
);