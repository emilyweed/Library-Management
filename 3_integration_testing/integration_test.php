<?php
require_once 'collect_data.php'; // Ensure your collect_data.php script is included

function testIntegration()
{
    $testQueries = [
        "harry potter", 
        "available", 
        "nonexistentbookquery", // Query with no results
    ];

    foreach ($testQueries as $query) {
        echo "Testing query: $query\n";

        // Call the fetchBookData function from collect_data.php
        $result = fetchBookData($query);

        // Verify the results
        if (isset($result['error'])) {
            echo "Error encountered: " . $result['error'] . "\n";
        } elseif (!empty($result['docs'])) {
            echo "Success: Fetched " . count($result['docs']) . " results.\n";

            // Optionally, display details of the first book
            $firstBook = $result['docs'][0];
            echo "First book title: " . ($firstBook['title'] ?? 'Unknown Title') . "\n";
            echo "Author: " . ($firstBook['author_name'][0] ?? 'Unknown Author') . "\n";
        } else {
            echo "No results found for query: $query\n";
        }

        echo "--------------------------------\n";
    }
}

// Run the integration tests
testIntegration();
?>