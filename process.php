<?php
require 'Database.php';
require 'User.php';

$db = (new Database())->connect();
$user = new User($db);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($action === 'Create') {
        if ($user->create($name, $email)) {
            header("Location: index.php?message=User created successfully");
        } else {
            header("Location: index.php?message=Error creating user");
        }
    } elseif ($action === 'Update') {
        if ($user->update($id, $name, $email)) {
            header("Location: index.php?message=User updated successfully");
        } else {
            header("Location: index.php?message=Error updating user");
        }
    } elseif ($action === 'Delete') {
        if ($user->delete($id)) {
            header("Location: index.php?message=User deleted successfully");
        } else {
            header("Location: index.php?message=Error deleting user");
        }
    }
    exit;
}
?>
