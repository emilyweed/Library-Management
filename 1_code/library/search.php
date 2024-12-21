<?php
// Include database connection
include('db.php');

// Get search query from the form
$bookTitle = $_POST['bookTitle'] ?? '';

// First, search in the local database
$sql = "SELECT * FROM media WHERE title LIKE ?";
$stmt = $conn->prepare($sql);
$searchQuery = "%" . $bookTitle . "%";
$stmt->bind_param("s", $searchQuery);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Book found in the database
    echo "<h2>Search Results from Local Database:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<strong>Title:</strong> " . $row["title"] . "<br>";
        echo "<strong>Author:</strong> " . $row["author"] . "<br>";
        echo "<strong>Description:</strong> " . $row["description"] . "<br>";
        echo "<strong>Available:</strong> " . ($row["available"] ? "Yes" : "No") . "<br>";
        echo "</div><hr>";
    }
} else {
    // Book not found, search the Open Library API
    echo "<h2>Searching Open Library...</h2>";
    $api_url = "https://openlibrary.org/search.json?q=" . urlencode($bookTitle);
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);

    if (isset($data['docs']) && count($data['docs']) > 0) {
        echo "<h2>Search Results from Open Library API:</h2>";
        foreach ($data['docs'] as $book) {
            $title = $book['title'] ?? 'Unknown Title';
            $author = isset($book['author_name'][0]) ? $book['author_name'][0] : 'Unknown Author';
            $year = $book['first_publish_year'] ?? 'Unknown Year';

            echo "<div>";
            echo "<strong>Title:</strong> $title<br>";
            echo "<strong>Author:</strong> $author<br>";
            echo "<strong>Year:</strong> $year<br>";
            echo "</div><hr>";

            // Optionally, add the book to your database
            $sqlInsert = "INSERT INTO media (title, type, description, available, author, year) 
                          VALUES (?, 'Book', 'Imported from Open Library', 1, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("sss", $title, $author, $year);
            $stmtInsert->execute();
        }
    } else {
        echo "No books found in Open Library API.";
    }
}

// Close the connection
$conn->close();
?>