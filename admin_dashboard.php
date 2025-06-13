<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$conn = new mysqli("localhost", "ue9qg2mcuyg25", "vtem140c9joo", "dby7l6k32jgng8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add article logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO articles (title, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $image);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard (No Login)</title>
    <style>
        body {
            font-family: Arial;
            padding: 40px;
            background: #f5f5f5;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background: #cc0000;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .article {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 6px solid #cc0000;
            border-radius: 6px;
        }
        img {
            max-width: 100%;
        }
    </style>
</head>
<body>

<h2>Add New Article</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Article Title" required>
    <textarea name="content" placeholder="Article Content" rows="5" required></textarea>
    <input type="text" name="image" placeholder="Image URL (optional)">
    <button type="submit">Post Article</button>
</form>

<h2>All Articles</h2>
<?php
$res = $conn->query("SELECT * FROM articles ORDER BY id DESC");
while ($row = $res->fetch_assoc()) {
    echo "<div class='article'>";
    if (!empty($row['image'])) {
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt=''>";
    }
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "</div>";
}
$conn->close();
?>

</body>
</html>
