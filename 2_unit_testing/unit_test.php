<?php
function testApiCall($api_url) {
    $response = file_get_contents($api_url);
    if ($response === false) {
        echo "API call failed.\n";
        return false;
    }
    $data = json_decode($response, true);
    if (!isset($data['docs']) || count($data['docs']) === 0) {
        echo "No results found.\n";
        return false;
    }
    echo "API call successful.\n";
    return true;
}

// Test cases
$test1 = testApiCall("https://openlibrary.org/search.json?q=harry+potter");
$test2 = testApiCall("https://openlibrary.org/search.json?q=invalidquery");
?>