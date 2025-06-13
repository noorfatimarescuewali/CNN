<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Connect to database
$conn = new mysqli("localhost", "ue9qg2mcuyg25", "vtem140c9joo", "dby7l6k32jgng8");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Initialize message
$message = "";

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare query securely
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $message = "❌ Incorrect password.";
        }
    } else {
        $message = "❌ Username not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            width: 350px;
        }
        h2 {
            color: #cc0000;
            text-align: center;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background: #cc0000;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
        }
        .msg {
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Admin Login</h2>
    
    <?php if ($message): ?>
        <div class="msg"><?= $message ?></div>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>

</body>
</html>
