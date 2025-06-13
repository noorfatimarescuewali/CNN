<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Article</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 80%; margin: 20px auto; background: white; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM articles WHERE id=$id";
        $result = $conn->query($sql);
        if ($row = $result->fetch_assoc()) {
            echo "<h1>{$row['title']}</h1>";
            echo "<img src='{$row['image']}' width='100%'>";
            echo "<p>{$row['content']}</p>";
        }
    }
    ?>
</div>

</body>
</html>
