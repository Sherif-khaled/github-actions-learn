<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

try {

    // SQL query to create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(50) NOT NULL,
                `email` VARCHAR(100) NOT NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    // Execute the query
    $db->exec($sql);
    echo "Table 'user' created successfully or already exists.";
} catch (PDOException $exception) {
    echo "Error creating table: " . $exception->getMessage();
}

$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();

echo "<a href='create.php'>Create User</a><br><br>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Actions</th>
</tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "<tr>
        <td>{$id}</td>
        <td>{$name}</td>
        <td>{$email}</td>
        <td>
            <a href='update.php?id={$id}'>Edit</a> | 
            <a href='delete.php?id={$id}'>Delete</a>
        </td>
    </tr>";
}

echo "</table>";

