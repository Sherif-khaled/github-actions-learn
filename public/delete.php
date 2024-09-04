<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

$query = "DELETE FROM users WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $id);

if ($stmt->execute()) {
    echo "User was deleted.";
} else {
    echo "Unable to delete user.";
}

echo "<br><a href='index.php'>Back to list</a>";

