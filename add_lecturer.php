<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: password.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // הגנה מפני CSRF - בדיקה שה-token המצוי בטופס תואם לאחד מאלו שנוצרו בסשן
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("הגישה נדחתה משום חשש מ- CSRF");
    }

    // הגנה מפני XSS - נשתמש בhtmlspecialchars כאשר מוצגים נתונים מהמסד
    function sanitize($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    // פרטי המסד
    $username = "root";
    $password = "";
    $database = "mailbox_management";
    $mysqli = new mysqli("localhost", $username, $password, $database);

    // בודקים אם הגישה למסד הנתונים עברה בהצלחה
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $name = sanitize($_POST["name"]);
    $mailbox = sanitize($_POST["mailbox"]);
    $phone = sanitize($_POST["phone"]);

    // הגנה מפני SQL Injection - משתמשים ב-prepare ו-bind_param
    $stmt = $mysqli->prepare("INSERT INTO lecturers (name, mailbox, phone, password, salt) VALUES (?, ?, ?, ?, ?)");
    $salt = bin2hex(random_bytes(32));
    $hashed_password = hash('sha256', $_POST["password"] . $salt);
    $stmt->bind_param("sssss", $name, $mailbox, $phone, $hashed_password, $salt);
    $stmt->execute();
    $stmt->close();

    echo "המרצה הוספה בהצלחה!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>הוספת מרצה</title>
</head>
<body>
    <h1>הוספת מרצה</h1>
    <form method="POST" action="add_lecturer.php">
        <label for="name">שם:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="mailbox">תיבת דואר:</label>
        <input type="text" id="mailbox" name="mailbox" required><br>

        <label for="phone">טלפון:</label>
        <input type="text" id="phone" name="phone" required><br>

        <!-- שדה סיסמה -->
        <label for="password">סיסמה:</label>
        <input type="password" id="password" name="password" required><br>

        <!-- הגנה מפני CSRF - הוספת ה-token לטופס -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <input type="submit" value="הוסף מרצה">
    </form>
</body>
</html>
