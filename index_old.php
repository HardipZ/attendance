<?php
require 'Database.php';
require 'User.php';

$db = (new Database())->connect();
$user = new User($db);

// Create a new user
$user->create('John Doe', 'john@example.com');

// Read all users
$users = $user->readAll();
echo "<h3>All Users</h3>";
foreach ($users as $u) {
    echo "ID: {$u['id']} | Name: {$u['name']} | Email: {$u['email']}<br>";
}

// Read a single user by ID
$singleUser = $user->readById(1);
echo "<h3>Single User</h3>";
echo "ID: {$singleUser['id']} | Name: {$singleUser['name']} | Email: {$singleUser['email']}<br>";

// Update a user
$user->update(1, 'Jane Doe', 'jane@example.com');

// Delete a user
$user->delete(2);
?>
