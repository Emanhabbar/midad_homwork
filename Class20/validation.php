<?php
session_start();

$username = "";
$email = "";
$age = "";
$password = "";
$confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);


    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    if (empty($age)) {
        $errors['age'] = "Age is required";
    } elseif (!is_numeric($age)) {
        $errors['age'] = "Age must be a number";
    } elseif ($age < 18) {
        $errors['age'] = "You must be at least 18 years old";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm password is required";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    if (empty($errors)) {
        $_SESSION['user'] = [
            'username' => $username,
            'email' => $email,
            'age' => $age,
            'password' => $password
        ];
        header("Location: success.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
</head>
<body>
    <h2>Register Form</h2>
    <form method="POST" action="">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
            <?php if(isset($errors['username'])) : ?>
                <p style="color: red;"><?= $errors['username'] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
            <?php if(isset($errors['email'])) : ?>
                <p style="color: red;"><?= $errors['email'] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?= htmlspecialchars($age) ?>">
            <?php if(isset($errors['age'])) : ?>
                <p style="color: red;"><?= $errors['age'] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <?php if(isset($errors['password'])) : ?>
                <p style="color: red;"><?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password">
            <?php if(isset($errors['confirm_password'])) : ?>
                <p style="color: red;"><?= $errors['confirm_password'] ?></p>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
