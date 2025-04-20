<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: validaion.php");
    exit;
}

$user = $_SESSION['user'];

$username = $user['username'];
$email = $user['email'];
$age = $user['age'];
$password = $user['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }
        .card {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: green;
            text-align: center;
            margin-bottom: 30px;
        }
        p {
            font-size: 18px;
            margin-bottom: 12px;
            color: #333;
        }
        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Registration Completed Successfully</h2>
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($age) ?></p>
        <p><strong>Password:</strong> <?= str_repeat('*', strlen($password)) ?></p>
    </div>
</body>
</html>
