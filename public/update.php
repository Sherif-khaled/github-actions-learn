<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

if ($_POST) {
    $query = "UPDATE users SET name=:name, email=:email WHERE id=:id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "User was updated.";
    } else {
        echo "Unable to update user.";
    }
}

$query = "SELECT * FROM users WHERE id = ? LIMIT 0,1";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $row['name'];
$email = $row['email'];
?>

<form action="update.php?id=<?php echo $id; ?>" method="post">
    <p>Name: <input type="text" name="name" value="<?php echo $name; ?>" required /></p>
    <p>Email: <input type="email" name="email" value="<?php echo $email; ?>" required /></p>
    <input type="submit" value="Update User" />
</form>

