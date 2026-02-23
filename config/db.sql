CREATE DATABASE gym_management;

use gym_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('member','trainer','admin') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE member_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100),
    phone_number VARCHAR(20),
    package VARCHAR(50),
    medical_check VARCHAR(100),
    budget VARCHAR(50),
    experience VARCHAR(50),
    height DECIMAL(5,2),
    weight DECIMAL(5,2),
    fitness_goal VARCHAR(100),
    address TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);



CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date DATE NOT NULL,
    payment_method VARCHAR(50) DEFAULT 'Cash',
    month VARCHAR(20),
    year INT,
    status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    role VARCHAR(20) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE trainer_details (
    trainer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    mail VARCHAR(100) NOT NULL UNIQUE,
    qualification VARCHAR(150) NOT NULL,
    register_date DATE DEFAULT CURRENT_DATE
);

INSERT INTO trainer_details 
(name, phone_number, address, mail, qualification, register_date) 
VALUES
('Daniel Carter', '0771234567', 'Colombo', 'daniel@gmail.com', 'Certified Personal Trainer', '2025-01-10'),
('Michael Fernando', '0712345678', 'Negombo', 'michael@gmail.com', 'Diploma in Sports Science', '2025-01-15'),
('Jason Perera', '0759876543', 'Kandy', 'jason@gmail.com', 'Strength & Conditioning Coach', '2025-01-20'),
('Ryan Silva', '0764567890', 'Gampaha', 'ryan@gmail.com', 'Certified Fitness Instructor', '2025-02-01'),
('Kevin Rodrigo', '0783456789', 'Kurunegala', 'kevin@gmail.com', 'Level 3 Personal Trainer', '2025-02-05'),
('Ethan Jayawardena', '0725678901', 'Kalutara', 'ethan@gmail.com', 'Nutrition & Fitness Specialist', '2025-02-10'),
('Sophie Williams', '0778899001', 'Colombo', 'sophie@gmail.com', 'Yoga & Pilates Instructor', '2025-02-15'),
('Emma Richardson', '0753344556', 'Negombo', 'emma@gmail.com', 'Certified Zumba Trainer', '2025-02-18'),
('Olivia Martinez', '0711122233', 'Kandy', 'olivia@gmail.com', 'HIIT Specialist', '2025-02-20'),
('Liam Anderson', '0769988776', 'Galle', 'liam@gmail.com', 'Advanced Bodybuilding Coach', '2025-02-22');
