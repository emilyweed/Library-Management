<?php
// Dummy book database
$books = [
    "The Great Gatsby" => ["status" => "available", "borrowedBy" => "", "holdList" => []],
    "1984" => ["status" => "available", "borrowedBy" => "", "holdList" => []],
    "To Kill a Mockingbird" => ["status" => "borrowed", "borrowedBy" => "user1", "holdList" => ["user2"]]
];

// Handle borrowing
if (isset($_POST['borrowTitle'])) {
    $borrowTitle = $_POST['borrowTitle'];

    if (isset($books[$borrowTitle])) {
        $book = $books[$borrowTitle];

        if ($book["status"] == "available") {
            $book["status"] = "borrowed";
            $book["borrowedBy"] = "user1"; // Assume the user is logged in (from session)
            echo "You borrowed '$borrowTitle'.";
        } else {
            echo "Sorry, this book is already borrowed.";
        }
    } else {
        echo "Book not found.";
    }
}
?>