# TopupRankAPI

TopupRankAPI is a simple API for managing the rank top-up system. It allows users to top-up ranks through a web interface and view transaction histories. This project is designed to integrate with Minecraft server systems, particularly to manage player ranks in a convenient way.

## Features

- **Top-up ranks**: Allows users to top-up their ranks.
- **Transaction history**: Users can view their transaction history for ranks they have purchased.
- **Admin dashboard**: Admins can manage all transactions and view detailed user data.
- **Authentication**: Secure login system for both users and admins.
- **API integration**: Easily integrates with your Minecraft server for rank management.

## Requirements

- PHP 7.4 or later
- MySQL or MariaDB for database storage
- cURL enabled for API communication
- A web server like Apache or Nginx

## Installation

### 1. Clone the repository
Clone this repository to your local machine or server.

```bash
git clone https://github.com/YourUsername/TopupRankAPI.git
```
## 2. Set up the database

Import the provided db.sql file into your MySQL database.
```sql
CREATE DATABASE topuprank;
USE topuprank;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Transactions Table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    rank VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username)
);

-- Insert default admin
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$HqvV/Uo5PfT7v6xlGeKPhui.kkKQn.XkgBQnnBoBTcKHb94QH4bsq', 'admin'); -- Password: admin123
```

## 3. Configuration

Update the database connection settings in includes/db.php to match your local or server configuration.
```
$host = 'localhost'; 
$user = 'your_username';
$pass = 'your_password';
$dbname = 'topuprank';
```
## 4. Set up API keys

To secure the API, ensure that the API key is set properly in api/middleware.php.
```
if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer your_api_key') {
    http_response_code(403);
    echo json_encode(['message' => 'Forbidden']);
    exit();
}
```
Replace 'your_api_key' with a secure key.

## 5. Deploy the application

Upload the files to your server or local environment. Ensure that your web server is configured correctly to serve the application.

# Usage
- 1. User Interface
Users can visit the web interface at index.php to log in or sign up.
After logging in, users can top-up their ranks and view their transaction history.

- 2. Admin Dashboard
Admins can log in via admin/login.php and access the dashboard to view all transactions.

- 3. API Requests
To interact with the API, send POST requests to api/middleware.php with the correct API key.
Example POST request for top-up:
```
curl -X POST -H "Authorization: Bearer your_api_key" -d "username=user1&rank=VIP" https://yourdomain.com/api/middleware.php
```
## Contributing

1. Fork the repository.
2. Create a new branch (git checkout -b feature-name).
3. Commit your changes (git commit -am 'Add feature').
4. Push to the branch (git push origin feature-name).
5. Create a new Pull Request.
