<?php
$url = 'http://127.0.0.1:3000/getdata';

// get data from test api
$jsonData = file_get_contents($url);

// Check if the request was successful
if ($jsonData !== false) {
    // Decode the JSON data to a PHP array
    $data = json_decode($jsonData, true);
} else {
    $data = ["no data"];
}

// get query string from request
$query = isset($_GET['query']) ? urldecode($_GET['query']) : '';

// Filter data based on query
$searchResults = array_filter($data, function ($item) use ($query) {
    return strpos($item, $query) === 0;
});

if ($data[0] === "no data") {
    $searchResults[0] = "failed to fetch data";
} elseif (empty($searchResults)) {
    $searchResults[0] = "no result";
}

// Return JSON response with search results
header('Content-Type: application/json');
echo json_encode(array_values($searchResults));