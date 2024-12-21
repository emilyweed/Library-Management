<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Dummy profile information (replace with real data or database queries)
$username = $_SESSION['user_id'];  // Using session variable for user info

// Dummy data for holds and borrowed books
$holds = [
    ['book' => 'Harry Potter and the Sorcerer\'s Stone', 'due_date' => '2024-12-25'],
    ['book' => 'The Great Gatsby', 'due_date' => '2024-12-30']
];

$borrowed = [
    ['book' => 'To Kill a Mockingbird', 'due_date' => '2025-01-15'],
    ['book' => '1984', 'due_date' => '2025-02-01']
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - The Book Burrow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }
        .profile-container h2 {
            font-size: 24px;
        }
        .profile-container p {
            font-size: 16px;
        }
        .book-list {
            margin-top: 20px;
            text-align: left;
        }
        .book-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .book-list th, .book-list td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .book-list th {
            background-color: #6f4f29;
            color: white;
        }
        .logout-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #6f4f29;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }
        .logout-button:hover {
            background-color: #8e5c4a;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>This is your profile page.</p>
        <p>Here are your current holds and borrowed books:</p>

        <!-- Holds Section -->
        <div class="book-list">
            <h3>Books on Hold</h3>
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($holds as $hold): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($hold['book']); ?></td>
                        <td><?php echo htmlspecialchars($hold['due_date']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Borrowed Books Section -->
        <div class="book-list">
            <h3>Borrowed Books</h3>
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borrowed as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['book']); ?></td>
                        <td><?php echo htmlspecialchars($book['due_date']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Logout Button -->
        <a href="logout.php">
            <button class="logout-button">Logout</button>
        </a>
    </div>

</body>
</html>