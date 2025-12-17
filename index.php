<?php
session_start();

if (!isset($_SESSION['hashedPassword'])) {
    $_SESSION['hashedPassword'] = "";
}

if (isset($_POST['hash'])) {
    $password = $_POST['password'];
    $_SESSION['hashedPassword'] = password_hash($password, PASSWORD_DEFAULT);
}

if (isset($_POST['verify'])) {
    $password = $_POST['password'];
    if (password_verify($password, $_SESSION['hashedPassword'])) {
        echo "<p><strong>Match</strong></p>";
    } else {
        echo "<p><strong>No Match</strong></p>";
    }
    unset($_SESSION['hashedPassword']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Hashing</title>
</head>
<body>

<form method="post">
    <label>Enter Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="hash" value="Hash Password">
    <input type="submit" name="verify" value="Verify Password">
</form>
<?php
if (!empty($_SESSION['hashedPassword'])) {
    echo "<p><strong>Hashed Password:</strong> " . $_SESSION['hashedPassword'] . "</p>";
}
?>
</body>
</html>
