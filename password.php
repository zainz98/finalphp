<?php
session_start();

require_once('UserManagement.php'); // קריאה לקובץ שמכיל את מנהל המשתמשים

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userManagement = new UserManagement(); // יצירת אובייקט מנהל המשתמשים

    if ($userManagement->authenticate($_POST["password"])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header('Location: add_lecturer.php');
        exit;
    } else {
        echo "סיסמה שגויה!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>הזן סיסמה</title>
</head>
<body>
    <h1>הזן סיסמה</h1>
    <form method="POST" action="password.php">
        <label for="password">סיסמה:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="המשך">
    </form>
</body>
</html>
