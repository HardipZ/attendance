<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>User Management</h1>

    <!-- User Form -->
    <form action="process.php" method="POST">
        <input type="hidden" name="id" id="userId" value="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <input type="submit" name="action" value="Create">
        <input type="submit" name="action" value="Update">
    </form>

    <!-- Users Table -->
    <h2>Users List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'Database.php';
            require 'User.php';

            $db = (new Database())->connect();
            $user = new User($db);

            $users = $user->readAll();
            foreach ($users as $u) {
                echo "<tr>
                    <td>{$u['id']}</td>
                    <td>{$u['name']}</td>
                    <td>{$u['email']}</td>
                    <td>
                        <button onclick=\"editUser({$u['id']}, '{$u['name']}', '{$u['email']}')\">Edit</button>
                        <form action='process.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='{$u['id']}'>
                            <input type='submit' name='action' value='Delete' onclick=\"return confirm('Are you sure?');\">
                        </form>
                    </td>
                </tr>";
            } 
            ?>
        </tbody>
    </table>

    <script>
        // Prefill the form for editing a user
        function editUser(id, name, email) {
            document.getElementById('userId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
        }
    </script>
</body>
</html>
