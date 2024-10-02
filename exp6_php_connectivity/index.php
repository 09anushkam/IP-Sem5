<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost"; // Usually 'localhost' for phpMyAdmin
$username = "root";        // Default MySQL username
$password = "";            // MySQL password (leave empty for localhost by default)
$dbname = "ContactForm";   // Replace with your database name

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables to store submitted data for display after submission
$submitted_name = "";
$submitted_email = "";

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!empty($name) && !empty($email)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO Userinfo (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email); // 'ss' means two strings

        // Execute the statement
        if ($stmt->execute()) {
            echo "<div class='success-msg'>New record created successfully!</div>";
            // Store the submitted values for display
            $submitted_name = $name;
            $submitted_email = $email;
        } else {
            echo "<div class='error-msg'>Error: " . $stmt->error . "</div>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<div class='error-msg'>Please fill in all fields.</div>";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .success-msg, .error-msg {
            padding: 10px;
            border-radius: 5px;
            max-width: 500px;
            margin: 10px auto;
            text-align: center;
        }
        .success-msg {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error-msg {
            background-color: #f2dede;
            color: #a94442;
        }
        .display-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Enter User Information</h2>

    <form action="" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php if (!empty($submitted_name) && !empty($submitted_email)) { ?>
    <div class="display-info">
        <h3>Submitted Information:</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($submitted_name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($submitted_email); ?></p>
    </div>
    <?php } ?>

</body>
</html>
