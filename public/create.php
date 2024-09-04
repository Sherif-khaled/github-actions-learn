<?php
require_once 'config/database.php';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO users SET name=:name, email=:email";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);

    if ($stmt->execute()) {
        echo "User was created.";
    } else {
        echo "Unable to create user.";
    }
}

?>

<form action="create.php" method="post">
    <p>Name: <input type="text" name="name" required /></p>
    <p>Email: <input type="email" name="email" required /></p>
    <input type="submit" value="Create User" />
</form>

