<?php
// Dummy book database
$books = [
    "The Great Gatsby" => ["status" => "available", "borrowedBy" => "", "holdList" => []],
    "1984" => ["status" => "available", "borrowedBy" => "", "holdList" => []],
    "To Kill a Mockingbird" => ["status" => "borrowed", "borrowedBy" => "user1", "holdList" => ["user2"]]
];

// Handle placing a book on hold
if (isset($_POST['holdTitle'])) {
    $holdTitle = $_POST['holdTitle'];

    if (isset($books[$holdTitle])) {
        $book = $books[$holdTitle];

        if (!in_array("user1", $book["holdList"])) { // Assume user is logged in
            $book["holdList"][] = "user1";
            echo "You placed '$holdTitle' on hold.";
        } else {
            echo "You're already on the hold list for '$holdTitle'.";
        }
    } else {
        echo "Book not found.";
    }
}
?>