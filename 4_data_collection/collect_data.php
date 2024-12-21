<?php
$api_url = "https://openlibrary.org/search.json?q=harry+potter";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if ($data) {
    file_put_contents("book_data.json", json_encode($data, JSON_PRETTY_PRINT));
    echo "Data saved to book_data.json.\n";
} else {
    echo "Failed to fetch data.\n";
}
?>