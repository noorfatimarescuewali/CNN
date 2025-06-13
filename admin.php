<?php include 'db.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial; text-align: center; padding: 50px; }
        .form-container { width: 300px; margin: auto; padding: 20px; background: white; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Admin Login</h2>
    <form method="post" action="admin_login.php">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
