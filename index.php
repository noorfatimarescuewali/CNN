<?php
$conn = new mysqli("localhost", "ue9qg2mcuyg25", "vtem140c9joo", "dby7l6k32jgng8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$articles = $conn->query("SELECT * FROM articles ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My News</title>
    <style>
        body { font-family: Arial; margin: 0; background: #f9f9f9; }
        header { background: #cc0000; color: white; padding: 20px; text-align: center; }
        .container { padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .card img { width: 100%; border-radius: 10px; }
        .card h3 { color: #cc0000; }
        .card p { font-size: 14px; }
    </style>
</head>
<body>

<header>
    <h1>My News Portal</h1>
</header>

<div class="container">
    <?php while ($row = $articles->fetch_assoc()): ?>
        <div class="card">
            <img src="<?= $row['image'] ?>" alt="News">
            <h3><?= $row['title'] ?></h3>
            <p><?= $row['description'] ?></p>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
