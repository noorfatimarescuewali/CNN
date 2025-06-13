<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$conn = new mysqli("localhost", "ue9qg2mcuyg25", "vtem140c9joo", "dby7l6k32jgng8");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $image = trim($_POST['image']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);

    // Validate fields
    if ($title && $image && $description && $content) {
        $stmt = $conn->prepare("INSERT INTO articles (title, image, description, content) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $image, $description, $content);

        if ($stmt->execute()) {
            $success = "✅ Article posted successfully!";
        } else {
            $error = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "❌ Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
    <style>
        body {
            font-family: Arial;
            background: #eef1f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        form {
            background: white;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #cc0000;
        }
        input, textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            background-color: #cc0000;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
        }
        .msg {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .msg.success {
            color: green;
        }
        .msg.error {
            color: red;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Post New Article</h2>

    <?php if ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="msg error"><?= $error ?></div>
    <?php endif; ?>

    <input type="text" name="title" placeholder="Enter article title" required />
    <input type="text" name="image" placeholder="Image URL (e.g., https://...)" required />
    <textarea name="description" placeholder="Short description (1-2 lines)" rows="3" required></textarea>
    <textarea name="content" placeholder="Full article content here..." rows="6" required></textarea>

    <button type="submit">Post Article</button>
</form>

</body>
</html>
